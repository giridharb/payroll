@extends('layouts.app')

@section('title', 'View Employee')

@section('content')
<link rel="stylesheet" href="{{ asset('css/fontawesome.css') }}">
<!-- Page Content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">View Employee</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="{{ route('employees.index') }}">Employee Management</a></li>
              <li class="breadcrumb-item active">View Employee</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">

      <div class="container-fluid">  
      
        <div class="row">
        <div id="accordion" class="col-12">
              <div class="card">
                <div class="card-header" id="headingOne">
                  <h5 class="mb-0 card-title">
                    <button class="btn btn-link" data-toggle="collapse" data-target="#personalInfo" aria-expanded="true" aria-controls="collapseOne">Employee Details </button>
                  </h5>
                </div>

                <div id="roleInfo" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                  <div class="card-body ">
                    <form class="card-form needs-validation" method="post" action="{{route('employees.store')}}" id="formAddEmployee" novalidate>
                      @csrf
                      <div class="form-row">
                        <div class="form-group col-md-4">
                          <label for="inputFirstName">First Name :</label>
                          {{$employee->first_name}}
                          
                        </div>

                        <div class="form-group col-md-4">
                          <label for="inputMiddleName">Middle Name : </label>
                          {{$employee->middle_name}}                         
                        </div>
                        
                        <div class="form-group col-md-4">
                          <label for="inputLastName">Last Name :</label>  
                          {{$employee->last_name}}                        
                        </div>
                      </div>

                      <div class="form-row">

                        <div class="form-group col-md-4">
                          <label for="inputEmail">Email Address :</label>
                          {{$employee->email_address}}
                        </div>

                        <div class="form-group col-md-4">
                          <label for="inputMobileNumber">Primary Phone :</label>
                          {{$employee->primary_phone}}
                        </div>
                        <div class="form-group col-md-4">
                          <label for="inputAdharNumber">Secondary Phone :</label>
                          {{$employee->secondary_phone}}
                        </div>
                      </div>
                      <div class="form-row">
                       
                        <div class="form-group col-md-4">
                          <label for="inputDateofBirth">Date of Birth :</label>
                          {{$employee->date_of_birth}}
                          
                        </div>
                        <div class="form-group col-md-4">
                          <label for="inputGender">Gender :</label>
                          {{$employee->gender}}
                        </div>

                        <div class="form-group col-md-4">
                          <label for="inputMarried">Date of Joining :</label>
                          {{$employee->date_of_joining}}
                        </div>
                      </div>
                      
                      <div class="form-row">
                       
                        <div class="form-group col-md-4">
                          <label for="inputDateofBirth">Designation :</label>
                          {{$employee->designation->name}}
                          
                        </div>
                        <div class="form-group col-md-4">
                          <label for="inputGender">Reporting Manager :</label>
                          {{$employee->manager->full_name}}
                        </div>

                        <div class="form-group col-md-4">
                          <label for="inputMarried">Photo :</label>

                          @if($employee->photo)
                          <img src="{{asset('profile_images/')}}/{{$employee->photo}}" width="50px" alt="{{$employee->full_name}}" class="img-circle elevation-2">
                          @else
                          <img src="https://ui-avatars.com/api/?background=f2f0ed&color=cf1518&bold=true&size=50&name={{$employee->full_name}}" class="img-circle elevation-2" alt="{{$employee->full_name}}">
                          @endif
                        </div>
                      </div>
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