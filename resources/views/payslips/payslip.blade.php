<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <title>Hartley Lab Payroll - Payslip</title>

<style> 
 .salary-slip {
  margin: 15px;
  padding:10px;
  border: 2px solid black;
}
.salary-slip .empDetail {
  width: 100%;
  text-align: left;
  border: 2px solid black;
  border-collapse: collapse;
  table-layout: fixed;
}
.salary-slip .head {
  margin: 10px;
  margin-bottom: 50px;
  width: 100%;
}
.salary-slip .companyName {
  text-align: left;
  font-size: 30px;
  font-weight: bold;
  line-height:35px;
  padding:15px;
}
.salary-slip .salaryMonth {
  text-align: center;
}
.salary-slip .table-border-bottom {
  border-bottom: 1px solid;
}
.salary-slip .table-border-right {
  border-right: 1px solid;
}
.salary-slip .myBackground td,.myBackground th {
  padding-top: 10px;
  text-align: left;
  border: 1px solid black;
  height: 40px;
}
.salary-slip .myAlign {
  text-align: right;
  border-right: 1px solid black;
  border-left: 1px solid black;
}

.salary-slip .border-center {
  text-align: center;
}
.salary-slip .border-center th, .salary-slip .border-center td {
  border: 1px solid black;
}

.salary-slip .border-bottom th, .salary-slip .border-bottom td {
  border: 1px solid black;
}

.salary-slip .border-left {
  border: 1px solid black;
}
.salary-slip th, .salary-slip td {
  padding-left: 6px;
  text-align:left;
}
.sml{
	font-size:8px;
	font-style:italic;
}
</style>
</head>
<body >
<div class="salary-slip" >
            <table class="empDetail">
              <tr height="100px" >
                <th colspan='5' class="companyName"> Hartley Lab Pvt. Ltd.</th>
				<td colspan='3'>
                  <img width="300px" src='images/fulllogo.png' alt="Logo"/></td>
              </tr>
			  <tr class="border-center">
				<th colspan="8"  style="font-size:26px;line-height:30px; text-align:center;">PAY SLIP - {{$payslip->month_of_pay->format('F Y') }}</th>
			  </tr>
			  <tr><td colspan="8">&nbsp;</td></tr>
			  <tr>
                <th colspan='2'>Name of the Employee</th>
                <td colspan='2'>{{$employee->full_name}}</td> 
                <th colspan='2'>No of Days in the Month</th>
                <td colspan='2'>{{$payslip->month_of_pay->daysInMonth}}</td>
              </tr>
			  <tr>
                <th colspan='2'>Employee Code</th>
                <td colspan='2'>{{$employee->employee_id}}</td> 
                <th colspan='2'>No of Days Worked</th>
                <td colspan='2'>{{$payslip->days_worked}}</td>
              </tr>
			  <tr>
                <th colspan='2'>Month</th>
                <td colspan='2'>{{$payslip->month_of_pay->format('F') }}</td> 
                <th colspan='2'>Date of Joining</th>
                <td colspan='2'>{{$employee->date_of_joining->format('M d, Y')}}</td>
              </tr>
			  <tr>
                <th colspan='2'>Bank Account No.</th>
                <td colspan='2'>-</td> 
                <th colspan='2'>Leave Balance</th>
                <td colspan='2'>{{$employee->salary->leave_balance}}</td>
              </tr>
			  <tr>
                <th colspan='2'>Designation</th>
                <td colspan='2'>{{$employee->designation->name}}</td> 
                <th colspan='2'>Leaves Taken</th>
                <td colspan='2'>{{$payslip->leaves_taken}}</td>
              </tr>
			  <tr><td colspan="8">&nbsp;</td></tr>
              <tr class="myBackground">
                <th colspan="3">Particulars</th>              
                <th class="table-border-right">Amount (Rs.)</th>
                <th colspan="3">Deductions</th>
                <th class="border-left">Amount (Rs.)</th>
              </tr>
              <tr>
                <th colspan="2">Basic Salary</th>
                <td></td>
                <td class="myAlign">{{number_format($payslip->basic_salary)}}</td>
                <th colspan="2" >Employee Provident Fund </th >
                <td></td>
                <td class="myAlign">{{number_format($payslip->employee_provident_fund)}}</td>
              </tr >
              <tr>
                <th colspan="2">HRA</th>
                <td></td>
                <td class="myAlign">{{number_format($payslip->hra)}}</td>
                <th colspan="2" >Employer Provident Fund</th >
                <td></td>
                <td class="myAlign">{{number_format($payslip->employer_provident_fund)}}</td>
              </tr >
              <tr>
                <th colspan="2">Fixed Conveyance Allowance</th>
                <td></td>
                <td class="myAlign">{{number_format($payslip->fix_conveyance)}}</td>
                <th colspan="2" >T D S</th >
                <td></td>
                <td class="myAlign">{{number_format($payslip->tds ?? 0)}}</td>
              </tr >
              <tr>
                <th colspan="2">Medical Allowance</th>
                <td></td>
                <td class="myAlign">{{number_format($payslip->medical_allowance)}}</td>
                <th colspan="2" >Professional Tax</th >
                <td></td>
                <td class="myAlign">{{number_format($payslip->professional_tax)}}</td>
              </tr >
              <tr>
                <th colspan="2">Internet Allowance</th>
                <td></td>
                <td class="myAlign">{{number_format($payslip->internet_allowance)}}</td>
                <th colspan="2" >Other</th >
                <td></td>
                <td class="myAlign">{{number_format($payslip->other_deduction)}}</td>
              </tr >
              <tr>
                <th colspan="2">Telephone</th> 
				<td></td>
                <td class="myAlign">{{number_format($payslip->telephone)}}</td>
                <th colspan="2" ></th >
                <td></td>
                <td class="myAlign"></td>
              </tr >
              <tr>
                <th colspan="2">Prof Development</th>
                <td></td>
                <td class="myAlign">{{number_format($payslip->prof_development )}}</td>
                <th colspan="2" ></th>
                <td></td>
                <td class="myAlign"></td>
              </tr >
              <tr>
                <th colspan="2">Special Allowance</th>
                <td></td>
                <td class="myAlign">{{number_format($payslip->special_allowance)}}</td>
                <th colspan="2"></th >
                <td></td>
                <td class="myAlign"></td>
              </tr >
              <tr class="myBackground">
                <th colspan="3">Gross Salary</th>
                <td style="text-align:right;">{{number_format($payslip->gross_salary)}}</td>
                <th colspan="3" >Total Deductions</th >
                <td style="text-align:right;">{{number_format($payslip->total_deductions)}}</td>
              </tr>
			  <tr><td colspan="8">&nbsp;</td></tr>
			  <tr>
				<td colspan="7"></td>
				<td class="table-border-bottom"></td>
			</tr>
              <tr height="40px">
                <th colspan="4">
                  For Hartley Labs
                </th>
                
                <th colspan="2" >
                  Net Take Home Pay
                </th >
                <td >
                </td>
                <td class="table-border-bottom" style="text-align:right;" >
                  Rs. {{number_format($payslip->net_salary)}}
                </td>
              </tr >
              <tr><td colspan="8">&nbsp;</td></tr>
			  <tr><th colspan="8">HR Department</th></tr>
            </table >
			<div class="sml">This is a computer generated report and required no signature</div>
          </div >
     
</body>
</html>