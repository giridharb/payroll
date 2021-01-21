<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Role;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $searchQuery = trim($request->query('search'));
        $requestData = ['first_name','last_name'];
        $employees    = Employee::with(["designation","salary"])->where(function($q) use($requestData, $searchQuery) {
            foreach ($requestData as $field)
               $q->orWhere($field, 'like', "%{$searchQuery}%");
        })->orderBy('id')->paginate(25);
     
        $employees->appends(['search' => $searchQuery]);

        return view('employees.index',['employees'=>$employees]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employee       = new Employee();
        $designations   = Role::all();
        $managers       = Employee::all();
        return view('employees.create',["employee"=>$employee,"designations"=>$designations,"managers"=>$managers]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'date_of_birth' => 'date',
            'gender' => 'required',
            'email_address' => 'required|email|unique:employees,email_address',
            'date_of_joining' => 'required|date',
            'primary_phone' => 'required',
            'designation_id' => 'required',
            'photo' => 'file|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
    
		$employee = Employee::create($request->all());
		
        if ($file = $request->file('photo')) {
           
            $destinationPath = public_path('/profile_images//');                
            $profileImage = date('YmdHis') . "." . $file->getClientOriginalExtension();
            $file->move($destinationPath, $profileImage);
 
            $employee->photo=$profileImage;
			$employee->update();
			
        }
        
        return redirect()->route('employees.index')->with('success', 'Employee record successfully created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {       
        $objEmployee =  Employee::with(["designation","manager"])->find($employee->id);
       
        return view('employees.view',["employee"=>$objEmployee]);
   
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        $designations   = Role::all();
        $managers       = Employee::all()->except($employee->id);
        return view('employees.edit',["employee"=>$employee,"designations"=>$designations,"managers"=>$managers]);
   
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        $this->validate($request, [            
            'first_name' => 'required',
            'last_name' => 'required',
            'date_of_birth' => 'date',
            'gender' => 'required',
            'email_address' => 'required|email|unique:employees,email_address,'.$employee->id,
            'date_of_joining' => 'required|date',
            'primary_phone' => 'required',
            'designation_id' => 'required',
            'photo' => 'file|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);    
       
                
        $oldPhoto = $employee->photo;
        $employee->update($request->all());

        if ($file = $request->file('photo')) {           
            
            $employee->removeOldPhoto($oldPhoto);

            $destinationPath = public_path('/profile_images//');   
            $profileImage = date('YmdHis') . "." . $file->getClientOriginalExtension();
            $file->move($destinationPath, $profileImage);
 
            $employee->photo=$profileImage;

            $employee->update();
         }

        return redirect()->route('employees.index')
                        ->with('success','Employee details updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {

        $employee-> removeOldPhoto($employee->photo);
        $employee->delete();
        
        return redirect()->route('employees.index')
                        ->with('success','Employee record deleted successfully');
    }	
	
}
