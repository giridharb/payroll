@extends('layouts.app')

@section('title', 'Role List')

@section('content')
<!-- Page Content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-4">
            <h1 class="m-0 text-dark">Role List</h1>
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
              <li class="breadcrumb-item"><a href="/">Home</a></li>
              <li class="breadcrumb-item active">Role List</li>
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
                <h3 class="card-title">Role List</h3>

               
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
                      <th>Role ID</th>                    
                      <th>Role</th>
                      <th>Created on</th>  
                      <th>Action</th>                      
                    </tr>
                  </thead>
                  <tbody>
               
                    @foreach ($roles as $role)
                    <tr>                     
                      <td>{{ $role->id }}</td>
                      <td><strong>{{$role->name}}</strong></td>
                      <td>{{ $role->created_at}}</td>
                      <td>
                        <form action="{{ route('roles.destroy',$role->id) }}" method="POST">

                          <a href="{{ route('roles.edit',$role->id) }}" ><i class="fas fa-user-edit"></i></a> &nbsp; 

                          @csrf
                          @method('DELETE')

                          <button type="submit" class="btn btn-danger"><i class="fas fa-user-minus"></i></button>
                        </form>
                                   
                      </td>
                    </tr>
                    @endforeach
                   
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                <div class="pagination pagination-sm m-0 float-right">{{ $roles->links() }}</div>
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