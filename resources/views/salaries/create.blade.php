@extends('layouts.app')

@section('title', 'Add Salary Details')

@section('content')
<link rel="stylesheet" href="{{ asset('css/fontawesome.css') }}">
<!-- Page Content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Add Salary Details</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="{{ route('employees.index') }}">Employee Management</a></li>
              <li class="breadcrumb-item active">Add Salary Details</li>
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
                    <button class="btn btn-link" data-toggle="collapse" data-target="#personalInfo" aria-expanded="true" aria-controls="collapseOne">Add New Employee</button>
                  </h5>
                </div>

                <div id="roleInfo" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                  <div class="card-body ">
                    <form class="card-form needs-validation" method="post" action="{{route('employees.store')}}" id="formAddEmployee" enctype="multipart/form-data" novalidate>
                      @csrf
                      <div class="form-row">
                        <div class="form-group col-md-4">
                          <label for="inputMonthlyGross">Monthly Gross Salary</label>
                          <input name="monthly_gross" value="" type="text" class="form-control" id="inputMonthlyGross" placeholder="Enter salary" required>
                          <div class="invalid-feedback">Enter first name.</div>
                        </div>

                        <div class="form-group col-md-4">
                          <label for="inputMiddleName">Middle Name</label>
                          <input name="middle_name" value="{{$employee->middle_name}}"  type="text" class="form-control" id="inputMiddleName" placeholder="Middle Name" >
                          <div class="invalid-feedback">Enter middle name.</div>
                        </div>
                        
                        <div class="form-group col-md-4">
                          <label for="inputLastName">Last Name</label>
                          <input name="last_name" value="{{$employee->last_name}}"  type="text" class="form-control" id="inputLastName" placeholder="Last Name" required>
                          <div class="invalid-feedback">Enter last name.</div>
                        </div>
                      </div>

                      <div class="form-row">
                        <div class="form-group col-md-4">
                          <label for="inputEmail">Email Address</label>
                          <input type="email" value="{{$employee->email_address}}" class="form-control" id="inputEmail" name="email_address" placeholder="email address" >
                          <div class="invalid-feedback">Enter email address.</div>
                        </div>

                        <div class="form-group col-md-4">
                          <label for="inputMobileNumber">Primary Phone</label>
                          <input type="text" minlength="10" maxlength="10" value="{{$employee->primary_phone}}"  class="form-control" id="inputMobileNumber" name="primary_phone" placeholder="phone number" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"  >
                          <div class="invalid-feedback">Enter phone number.</div>
                        </div>
                        <div class="form-group col-md-4">
                          <label for="inputSecondaryPhone">Secondary Phone</label>
                          <input type="text" minlength="10" maxlength="10" value="{{$employee->secondary_phone}}"  class="form-control" id="inputMobileNumber" name="secondary_phone" placeholder="phone number" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"  >
                          <div class="invalid-feedback">Enter phone number.</div>
                        </div>
                      </div>


                      <div class="form-row">
                       
                        <div class="form-group col-md-4">
                          <label for="inputDateofBirth">Date of Birth</label>
                          <input class="form-control" type="date" value="{{$employee->date_of_birth}}" placeholder="dd-mm-yyyy" 
        min="1900-01-01" max="{{ date('Y-m-d') }}"  id="inputDateofBirth" name="date_of_birth" required>
                          <div class="invalid-feedback">Enter date of birth.</div>
                        </div>

                        <div class="form-group col-md-4">
                          <label for="inputGender">Gender</label>
                          <select id="inputGender" name="gender" class="form-control" required>
                              <option selected value="">Choose...</option>
                              <option value="male"  @if($employee->gender=='male') selected @endif >Male</option>
                              <option value="female"  @if($employee->gender=='female') selected @endif>Female</option>
                          </select>
                          <div class="invalid-feedback">Select gender.</div>
                        </div>

                        <div class="form-group col-md-4">
                          <label for="inputDateofJoining">Date of Joining</label>
                          <input class="form-control" type="date" value="{{$employee->date_of_joining}}" placeholder="dd-mm-yyyy" 
        min="1970-01-01" max="{{ date('Y-m-d') }}"  id="inputDateofJoining" name="date_of_joining" required>
                          <div class="invalid-feedback">Enter date of Joining.</div>
                        </div>

                      </div>


                      <div class="form-row">
                        
                        <div class="form-group col-md-4">
                          <label for="inputDesignation">Designation</label>
                          <select id="inputDesignation" name="designation_id" class="form-control" required>
                              <option selected value="">Choose...</option>
                              @foreach($designations as $designation)
                              <option value="{{$designation->id}}" @if($employee->designation_id==$designation->id) selected @endif>{{$designation->name}}</option>
                              @endforeach
                             
                          </select>
                          <div class="invalid-feedback">Select Designation.</div>
                        </div>
                        <div class="form-group col-md-4">
                          <label for="inputReportingManager">Reporting Manager</label>
                          <select id="inputReportingManager" name="reporting_manager_id" class="form-control" required>
                              <option selected value="">Choose...</option>
                              @foreach($managers as $manager)
                              <option value="{{$manager->id}}" @if($employee->reporting_manager_id==$manager->id) selected @endif>{{$manager->full_name}}</option>
                              @endforeach
                          </select>
                          <div class="invalid-feedback">Select Reporting Manager.</div>
                        </div>
                        
                        <div class="form-group col-md-4">
                          <label for="inputHandicaped">Photo</label>
                          <input type="file"  class="form-control" id="inputPhoto" name="photo" placeholder="upload photo"  >
                          
                          <div class="invalid-feedback">Select photo.</div>
                        </div>
                      </div>



                      <button type="submit" class="btn btn-primary filled-button" >Save</button>
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

@endsection