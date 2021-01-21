@extends('layouts.app')

@section('title', 'Employee List')

@section('content')
<!-- Page Content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-4">
            <h1 class="m-0 text-dark">Employee List</h1>
          </div><!-- /.col -->

          <div class="col-sm-4">
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif
          </div>
          <div class="col-sm-4">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
              <li class="breadcrumb-item active">Employee List</li>
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
        
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Employee List</h3>

               
                <div class="card-tools">

                  <form>
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="search" class="form-control float-right" value="{{ request()->get('search') }}" placeholder="Search">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                    </div>
                  </div>
                  </form>
                </div>

              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>  
                      <th>Employee ID</th>  
                      <th>Profile Photo</th>                  
                      <th>Employee Name</th>
                      <th>Designation</th>
                      <th>Join Date</th>  
                      <th>Action</th>                      
                    </tr>
                  </thead>
                  <tbody>
               
                    @foreach ($employees as $employee)
                    <tr>                     
                      <td>{{ $employee->employee_id }}</td>
                      <td>
                         @if($employee->photo)
                          <img src="{{asset('profile_images/')}}/{{$employee->photo}}" width="50px" alt="{{$employee->full_name}}" class="img-circle elevation-2">
                          @else
                          <img src="https://ui-avatars.com/api/?background=f2f0ed&color=cf1518&bold=true&size=50&name={{$employee->full_name}}" class="img-circle elevation-2" alt="{{$employee->full_name}}">
                          @endif
                      </td>
                      <td><strong>{{$employee->full_name}}</strong></td>
                      <td><strong>{{$employee->designation->name}}</strong></td>
                      <td>{{ $employee->date_of_joining}}</td>
                      <td>
                        <form action="{{ route('employees.destroy',$employee->id) }}" method="POST">
                          <a href="{{ route('employees.show',$employee->id) }}" title="View Employee"><i class="fas fa-user-check"></i></a> &nbsp;
                          <a href="{{ route('employees.edit',$employee->id) }}" title="Edit Employee"><i class="fas fa-user-edit"></i></a> &nbsp; 

                          @csrf
                          @method('DELETE')

                          <button type="submit" class="btn btn-danger"><i class="fas fa-user-minus"></i></button> &nbsp;
                          <a href="{{ route('salaries.index',$employee->id) }}" title="Payroll" class="btn btn-success">Payroll</a>
                        </form>
                                   
                      </td>
                    </tr>
                    @endforeach
                   
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                <div class="pagination pagination-sm m-0 float-right">{{ $employees->links() }}</div>
              </div>
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
    
@endsection

@section('page-script')

@endsection