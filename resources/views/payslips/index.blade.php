@extends('layouts.app')

@section('title', 'Payroll Management')

@section('content')
<!-- Page Content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-4">
            <h1 class="m-0 text-dark">Payroll Management</h1>
          </div><!-- /.col -->

          <div class="col-sm-4">
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif
			@if ($message = Session::get('error'))
                <div class="alert alert-danger">
                    <p>{{ $message }}</p>
                </div>
            @endif
          </div>
          <div class="col-sm-4">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="{{ route('employees.index') }}">Employee Management</a></li>
              <li class="breadcrumb-item active">Payroll Management</li>
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
        
        <div id="accordion" class="col-12">
              <div class="card">
                <div class="card-header" id="headingOne">
                  <h5 class="mb-0 card-title">
                    <button class="btn btn-link" data-toggle="collapse" data-target="#personalInfo" aria-expanded="true" aria-controls="collapseOne">Enter Payroll Details to Generate Payslip</button>
                  </h5>
                </div>

                <div id="roleInfo" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                  <div class="card-body ">
                    <form class="card-form needs-validation" method="post" action="{{route('employee.payslips.store',$employee->id)}}" id="formAddSalary" novalidate>
                      @csrf
                      <div class="form-row">
                        <div class="form-group col-md-4">
                          <label for="inputFirstName">Month of Salary</label>
                          <div>
                            <select id="selectMonth" name="month" class="form-control " required style="width:80px;float:left;margin-right:5px;">
                                <option selected value="">Choose...</option>
                                @foreach(range(1,12) as $month)
                                <option value="{{$month}}">{{$month}}</option>
                                @endforeach
                            </select>
                            <select id="selectMonth" name="year" class="form-control pull-left" required style="width:80px">
                                <option selected value="">Choose...</option>
                                @foreach(range(2020,date('Y')) as $year)
                                <option value="{{$year}}">{{$year}}</option>
                                @endforeach
                            </select>
                          </div>
                          <div class="invalid-feedback">Choose month of salary.</div>
                        </div>

                        <div class="form-group col-md-4">
                          <label for="inputMonthlyGross">Monthly Gross Salary</label>
                          <input name="monthly_gross" value="{{$employee->salary->monthly_gross ?? ''}}"  type="text" class="form-control" id="inputMonthlyGross" placeholder="Enter monthly gross salary" >
                          <div class="invalid-feedback">Enter monthly gross salary.</div>
                        </div>
                        
                        <div class="form-group col-md-4">
                          <label for="inputLeaveBalance">Total Leave Balance</label>
                          <input name="leave_balance" value="{{$employee->salary->leave_balance ?? ''}}"  type="text" class="form-control" id="inputLeaveBalance" placeholder="Enter total leave balance" required>
                          <div class="invalid-feedback">Enter leave balance.</div>
                        </div>

                        <div class="form-group col-md-4">
                          <label for="inputDaysWorked">No of Days Worked</label>
                          <input name="days_worked" value=""  type="text" class="form-control" id="inputLeavesTaken" placeholder="Days taken for selected month" required>
                          <div class="invalid-feedback">Enter days worked.</div>
                      </div>

                      <div class="form-group col-md-4">
                          <label for="inputLeavesTaken">No of Days Leaves Taken</label>
                          <input name="leaves_taken" value=""  type="text" class="form-control" id="inputLeavesTaken" placeholder="Leaves taken for selected month" required>
                          <div class="invalid-feedback">Enter leave taken.</div>
                      </div>
                      <div class="col-md-4" style="padding-top:5px;">
                          </br>
                          <button type="submit" class="btn btn-primary filled-button" >Generate Payslip</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>

              </div>
            
            </div>
        


          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Employee Payslips</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th width="10%">Payslip ID</th>
                      <th width="20%">Month of Pay</th>			  
					  <th width="20%">Days Worked</th>
					  <th width="20%">Leaves Taken</th>
                      <th width="10%">Email Sent</th>  
                      <th width="20%">Action</th>                      
                    </tr>
                  </thead>
                  <tbody>
               
                    @if($payslips)
                    @foreach ($payslips as $payslip)
                    <tr>                     
                      <td>{{ $payslip->id }}</td>
                      <td>{{ $payslip->month_of_pay->format('F, Y')}}</td>
					  <td>{{ $payslip->days_worked}}</td>
					  <td>{{ $payslip->leaves_taken}}</td>
                      <td>{{ $payslip->email_sent_status}}</td>
                      <td>
                        <form action="{{ route('employee.payslips.destroy',[$payslip->employee->id,$payslip->id]) }}" method="POST">
                          <a href="{{ route('employee.payslips.edit',[$payslip->employee->id,$payslip->id]) }}" title="Edit Payslip">Edit </a> &nbsp;
                          <a href="{{ route('employee.payslips.show',[$payslip->employee->id,$payslip->id]) }}" title="Preview Payslip">Preview</a> &nbsp;
                          
                          <a href="/payslip/{{$payslip->id}}/send" title="Send Email">Send Email</a> &nbsp; 

                          @csrf
                          @method('DELETE')

                          <!-- <button type="submit" class="btn btn-danger"><i class="fas fa-user-minus"></i></button> -->
                          
                        </form>
                                   
                      </td>
                    </tr>
                    @endforeach
                    @else
                    <tr><td colspan="3">No payslips found</td></tr>
                    @endif
                   
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                <div class="pagination pagination-sm m-0 float-right">{{ $payslips->links() }}</div>
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