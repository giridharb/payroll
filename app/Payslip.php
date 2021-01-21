<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payslip extends Model
{
    protected $dates= ['month_of_pay'];
	protected $appends = ['total_deductions'];
	
    public function employee(){
        return $this->belongsTo('App\employee');
    }

    public static function calculate($arrParams){

		// Generate Month of Pay Value
        $dateMonthofPay = $arrParams['year'].'-'.str_pad($arrParams['month'],2,'0',STR_PAD_LEFT).'-01';

		// Fetch payslip
        $objPayslip = static::where(['employee_id'=>$arrParams['employee_id'],'month_of_pay'=>$dateMonthofPay])->first();
        
        if($objPayslip){
            return false;
        }
		$objPayslip = new static();
        $objPayslip->employee_id = $arrParams['employee_id'];
        $objPayslip->month_of_pay = $dateMonthofPay;
        $objPayslip->days_worked = $arrParams['days_worked'];
        $objPayslip->leaves_taken = $arrParams['leaves_taken'];

        $objPayslip->gross_salary = $arrParams['monthly_gross'];
		
		$objPayslip->calculateBasicSalary();
		
		$objPayslip->calculateHRA();
		
		$objPayslip->setAllownaceFromConfig();
       
        $objPayslip->setDeductionsFromConfig();
		
		
		$intLeaveBalance = $arrParams['leave_balance'] - $arrParams['leaves_taken'];
		 
		$arrParams['objSalary']->leave_balance = ($intLeaveBalance > 0 )?$intLeaveBalance:0;
		
		$intLeaveDeductions = $objPayslip->calculateLeavesDeductions($intLeaveBalance);
		
		$objPayslip->other_deduction = $intLeaveDeductions;
		
		$objPayslip->calculateSpecialAllowance();
		
		$objPayslip->calculateNetSalary();
        
        $objPayslip->save();
		
		return true;
    }
	
	public function setAllownaceFromConfig(){
		$this->fix_conveyance = env('FIX_CONVEYANCE',1600);
        $this->medical_allowance = env('MEDICAL_ALLOWANCE',1250);
        $this->internet_allowance = env('INTERNET_ALLOWANCE',1000);
        $this->telephone = env('TELEPHONE_ALLOWANCE',1000);
        $this->prof_development = env('PROF_DEVELOPMENT',2000);
	}
	
	public function setDeductionsFromConfig(){
		$this->employee_provident_fund = env('PROVIDENT_FUND',1800);
        $this->employer_provident_fund = env('PROVIDENT_FUND',1800);
        $this->tds = ($this->tds>0)?$this->tds:0;
        $this->professional_tax = env('PROFESSIONAL_TAX',200);
	}
	
	public function calculateBasicSalary(){
		$this->basic_salary = $this->gross_salary*40/100;
	}
	
	public function calculateHRA(){
		$this->hra = $this->basic_salary*16/100;
	}
	
	public function calculateLeavesDeductions($intLeaveBalance){
		
		$intLeavesDeduction = 0;
		$daySalary = $this->gross_salary/30;
		
		if($intLeaveBalance<0){
			$intLeavesDeduction = $daySalary * abs( $intLeaveBalance);
		}
		return $intLeavesDeduction;
	}
	
	public function getSumofRemaining(){
		$sumOfRemaining = ( $this->basic_salary+$this->hra+$this->fix_conveyance+$this->medical_allowance+$this->internet_allowance+$this->telephone+$this->prof_development);
		
		return $sumOfRemaining;
	}
	
	public function getTotalDeductions(){
		$totalDeduction = $this->employee_provident_fund+$this->employer_provident_fund+$this->tds+$this->professional_tax+$this->other_deduction;
		return $totalDeduction;
	}
	
	public function calculateSpecialAllowance(){
		
		$totalDeduction = $this->getTotalDeductions();
		$sumOfRemaining = $this->getSumofRemaining();
		
		$this->special_allowance=($this->gross_salary -$totalDeduction)-$sumOfRemaining;
	}
	
	public function calculateNetSalary(){
		$this->net_salary=$this->gross_salary-$this->getTotalDeductions();
	}
	
	public function getTotalDeductionsAttribute() {
        return $this->getTotalDeductions();
    }
}
