<?php

namespace App\Http\Controllers;

use App\Payslip;
use App\Employee;
use App\Salary;
use PDF;
use App\Mail\PayslipGenerated;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class PayslipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Employee $employee)
    {
       
        $employee->loadMissing('salary'); 

        $arrobjPayslips = Payslip::with('employee')->where('employee_id',$employee->id)->orderBy('month_of_pay','desc')->paginate(10);
        return view("payslips.index",["payslips"=>$arrobjPayslips,"employee"=>$employee]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Employee $employee)
    {
        $this->validate($request, [
            'monthly_gross' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'leave_balance' => 'required',
            'days_worked' => 'required',
            'month' => 'required',
            'year' => 'required'
        ]);

        $objSalary= Salary::where('employee_id',$employee->id)->first();

        if(!$objSalary){
            $objSalary = new Salary();
        }

        // store salary details for employee
       
        $objSalary->employee_id   = $employee->id;
        $objSalary->monthly_gross = $request->input('monthly_gross');
		
        // payslip calculate
        $arrParams =[
			'employee_id'=>$employee->id,
			'monthly_gross'=>$objSalary->monthly_gross,
			'leave_balance'=>$request->input('leave_balance'),
			'days_worked'=>$request->input('days_worked'),
			'month'=>$request->input('month'),
			'year'=>$request->input('year'),
			'leaves_taken'=>$request->input('leaves_taken'),
			'objSalary'=>$objSalary
        ];
        
		if(Payslip::calculate($arrParams)){
			
			$objSalary->save();
			
			return redirect()->route('employee.payslips.index',$employee->id)->with('success', 'payslip successfully created');
		} else {
			return redirect()->route('employee.payslips.index',$employee->id)->with('error', 'payslip already generated for selected month');
		}
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Payslip  $payslip
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee,Payslip $payslip)
    {
		$employee->loadMissing('salary');
		$employee->loadMissing('designation');		
        $pdf = PDF::loadView('payslips.payslip',['employee'=>$employee,'payslip'=>$payslip]);
        return $pdf->stream('payslip.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Payslip  $payslip
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee,Payslip $payslip)
    {
        $employee->loadMissing('salary');
		return view('payslips.edit',['employee'=>$employee,'payslip'=>$payslip]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Payslip  $payslip
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Employee $employee,Payslip $payslip)
    {
        $this->validate($request, [
            'gross_salary' => 'required|regex:/^\d+(\.\d{1,2})?$/',            
            'days_worked' => 'required',
			'fix_conveyance' => 'required|regex:/^\d+(\.\d{1,2})?$/',  
			'medical_allowance' => 'required|regex:/^\d+(\.\d{1,2})?$/',  
			'internet_allowance' => 'required|regex:/^\d+(\.\d{1,2})?$/',  
			'telephone' => 'required|regex:/^\d+(\.\d{1,2})?$/',  
			'prof_development' => 'required|regex:/^\d+(\.\d{1,2})?$/',
			
			'employee_provident_fund' => 'required|regex:/^\d+(\.\d{1,2})?$/',
			'employer_provident_fund' => 'required|regex:/^\d+(\.\d{1,2})?$/',
			'professional_tax' => 'required|regex:/^\d+(\.\d{1,2})?$/'
            
        ]);
		
		$payslip->days_worked = $request->input('days_worked');		
		$payslip->leaves_taken  = $request->input('leaves_taken');		
		$payslip->gross_salary  = $request->input('gross_salary');
		
		$payslip->hra   = $request->input('hra');
		$payslip->fix_conveyance   = $request->input('fix_conveyance');
		$payslip->medical_allowance   = $request->input('medical_allowance');
		$payslip->internet_allowance   = $request->input('internet_allowance');
		$payslip->telephone   = $request->input('telephone');
		$payslip->prof_development   = $request->input('prof_development');
				
		$payslip->employee_provident_fund   = $request->input('employee_provident_fund');
		$payslip->employer_provident_fund   = $request->input('employer_provident_fund');
		$payslip->tds    = $request->input('tds');
		$payslip->professional_tax    = $request->input('professional_tax');
		
		$payslip->calculateBasicSalary();
		
		$payslip->calculateHRA();
		
		$payslip->calculateSpecialAllowance();
		
		$payslip->calculateNetSalary();
        
        $payslip->save();
		
		return redirect()->route('employee.payslips.index',$employee->id)->with('success', 'payslip successfully updated');
		
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Payslip  $payslip
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payslip $payslip)
    {
        //
    }
	
	public function send($id){
		
		$payslip = Payslip::find($id);
		
		$employee = Employee::with(['salary','designation'])->find($payslip->employee_id);
		
		$fileName = $employee->employee_id.'-'.$payslip->month_of_pay->format("F-Y").".pdf";
		$storagePath = storage_path('payslips/'.$fileName);
		
		if(file_exists($storagePath)){
			unlink($storagePath);
		}
		
		$pdf = PDF::loadView('payslips.payslip',['employee'=>$employee,'payslip'=>$payslip]);		
		$pdf->save($storagePath);				
        
		$payslip->payslip_file 		= $storagePath;
		$payslip->email_sent_status = 'yes';
		$payslip->save();
		
		// Sending payslip 
		Mail::to($employee->email_address)->send(new PayslipGenerated($payslip,$employee));
		
		return redirect()->route('employee.payslips.index',$employee->id)->with('success', 'Payslip successfully sent');
		
	}
}
