@extends('layouts.app')

@section('title', 'Modify Role')

@section('content')
<link rel="stylesheet" href="{{ asset('css/fontawesome.css') }}">
<!-- Page Content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Edit Role</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Role Management</a></li>
              <li class="breadcrumb-item active">Edit Role</li>
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
                    Update Role 
                    </button>
                  </h5>
                </div>

                <div id="roleInfo" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                  <div class="card-body ">
                    <form class="card-form needs-validation" id="formUpdateRole" method="post" action="{{ route('roles.update',$role->id) }}" novalidate>
                    @csrf
                    @method('PUT')
                    

                      <div class="form-row">
                        <div class="form-group col-md-12">
                          <label for="inputRoleName">Role</label>
                          <input name="name" value="{{$role->name}}" type="text" class="form-control" id="inputRoleName" placeholder="Role Name" required>
                          <div class="invalid-feedback">Enter role name.</div>
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
<script src="{{ asset('js/address.js') }}"></script>
<script src="{{ asset('js/profile_20200919.js') }}"></script>
@endsection