@extends('layouts.app')

@section('title', 'Modify Payslip')

@section('content')
<link rel="stylesheet" href="{{ asset('css/fontawesome.css') }}">
<!-- Page Content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Modify Payslip</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
              <li class="breadcrumb-item">
			  <a href="{{ route('employee.payslips.index',$employee->id) }}">Payroll Management</a></li>
              <li class="breadcrumb-item active">Modify Payslip</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">   
        @if ($errors->any())
          <div class="alert alert-danger">
              <strong>Whoops!</strong> There were some problems with your input.<br><br>
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
        @endif
        <div class="row">
        <div id="accordion" class="col-12">
              <div class="card">
                <div class="card-header" id="headingOne">
                  <h5 class="mb-0 card-title">
                    <button class="btn btn-link" data-toggle="collapse" data-target="#personalInfo" aria-expanded="true" aria-controls="collapseOne">
                    Modify Payslip 
                    </button>
                  </h5>
                </div>

                <div id="roleInfo" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                  <div class="card-body ">
                    <form class="card-form needs-validation" id="formUpdatePayslip" method="post" action="{{ route('employee.payslips.update',[$employee->id,$payslip->id]) }}" enctype="multipart/form-data" novalidate>
                    @csrf
                    @method('PUT')

                    <div class="form-row">
						<div class="form-group col-md-4">
                          <label for="inputFullID	">Employee ID : </label>
                          {{$employee->employee_id}}
                        </div>
                        <div class="form-group col-md-4">
                          <label for="inputFullName">Employee Name : </label>
                          {{$employee->full_name}}
                        </div>                        
                        <div class="form-group col-md-4">
                          <label for="inputFullName">Month of Pay : </label>
                          {{$payslip->month_of_pay->format('F Y') }}
                        </div> 
                      </div>

                      <div class="form-row">
                        <div class="form-group col-md-4">
                          <label for="inputGross">Gross Salary</label>
                          <input type="text" value="{{$payslip->gross_salary}}" class="form-control" id="inputEmail" name="gross_salary" placeholder="" >
                          <div class="invalid-feedback">Enter Gross salary.</div>
                        </div>
                        <div class="form-group col-md-4">
                          <label for="inputDaysWorked">No of Days Worked</label>
                          <input name="days_worked" value="{{$payslip->days_worked}}"  type="text" class="form-control" id="inputDaysWorked" placeholder="Days taken for selected month" required>
                          <div class="invalid-feedback">Enter days worked.</div>
                      </div>
					  <div class="form-group col-md-4">
                          <label for="inputLeavesTaken">No of Days Leaves Taken</label>
                          <input name="leaves_taken" value="{{$payslip->leaves_taken}}"  type="text" class="form-control" id="inputLeavesTaken" placeholder="Leaves taken for selected month" required>
                          <div class="invalid-feedback">Enter leave taken.</div>
                      </div>
					  
                      </div>


					<div class="form-row">
                        
                        <div class="form-group col-md-4">
                          <label for="inputDaysWorked">Fixed Conveyance</label>
                          <input name="fix_conveyance" value="{{$payslip->fix_conveyance}}"  type="text" class="form-control" id="inputFixConveyance" placeholder="Fix Conveyance" required>
                          <div class="invalid-feedback">Enter Fixed Conveyance.</div>
                      </div>
					  <div class="form-group col-md-4">
                          <label for="inputMedicalAllowance">Medical Allowance</label>
                          <input name="medical_allowance" value="{{$payslip->medical_allowance}}"  type="text" class="form-control" id="inputMedicalAllowance" placeholder="Medical Allowance" required>
                          <div class="invalid-feedback">Enter Medical Allowance.</div>
                      </div>
					  <div class="form-group col-md-4">
                          <label for="inputInternetAllowance">Internet Allowance</label>
                          <input type="text" value="{{$payslip->internet_allowance}}" class="form-control" id="inputEmail" name="internet_allowance" placeholder="" >
                          <div class="invalid-feedback">Enter Internet Allowance.</div>
                        </div>
				  </div>
				  
				  
					<div class="form-row">
                        
                        <div class="form-group col-md-6">
                          <label for="inputTelephone">Telephone</label>
                          <input name="telephone" value="{{$payslip->telephone}}"  type="text" class="form-control" id="inputTelephone" placeholder="" required>
                          <div class="invalid-feedback">Enter Telephone Allowance.</div>
                      </div>
					  <div class="form-group col-md-6">
                          <label for="inputProfDevelopment">Prof Development</label>
                          <input name="prof_development" value="{{$payslip->prof_development}}"  type="text" class="form-control" id="inputProfDevelopment" placeholder="" required>
                          <div class="invalid-feedback">Enter Prof Development.</div>
                      </div>
					  
                      </div>
					  
					  
					  <div class="form-row">
                        
                        <div class="form-group col-md-4">
                          <label for="inputEmployeeProvidentFund">Employee Provident Fund</label>
                          <input name="employee_provident_fund" value="{{$payslip->employee_provident_fund}}"  type="text" class="form-control" id="inputEmployeeProvidentFund" placeholder="" required>
                          <div class="invalid-feedback">Enter employee provident fund.</div>
                      </div>
					  <div class="form-group col-md-4">
                          <label for="inputEmployerProvidentFund">Employee Provident Fund</label>
                          <input name="employer_provident_fund" value="{{$payslip->employer_provident_fund}}"  type="text" class="form-control" id="inputEmployerProvidentFund" placeholder="" required>
                          <div class="invalid-feedback">Enter employer provident fund.</div>
                      </div>
					  
						<div class="form-group col-md-4">
                          <label for="inputTDS">T D S</label>
                          <input type="text" value="{{$payslip->tds}}" class="form-control" id="inputTDS" name="tds" placeholder="" >
                          <div class="invalid-feedback">Enter T D S.</div>
                        </div>
                      </div>
					  
					  <div class="form-row">
                        
                        <div class="form-group col-md-6">
                          <label for="inputProfessionalTax">Professional Tax</label>
                          <input name="professional_tax" value="{{$payslip->professional_tax}}"  type="text" class="form-control" id="inputProfessionalTax" placeholder="" required>
                          <div class="invalid-feedback">Enter professional tax.</div>
                      </div>
					  <div class="form-group col-md-6">
                          <label for="inputOtherDeduction">Other Deduction</label>
                          <input name="other_deduction" value="{{$payslip->other_deduction}}"  type="text" class="form-control" id="inputOtherDeduction" placeholder="" required>
                          <div class="invalid-feedback">Enter other deduction.</div>
                      </div>
					  
                      </div>
                      <button type="submit" class="btn btn-primary filled-button" >Update</button>
                  </form>
                  </div>
                </div>
              </div>             
                
            </div>
        </div>
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
    
@endsection

@section('page-script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>

@endsection