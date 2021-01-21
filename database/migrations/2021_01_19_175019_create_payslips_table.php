<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePayslipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payslips', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->bigInteger('employee_id')->unsigned()->index();
            $table->date('month_of_pay');
            $table->integer('days_worked');
            $table->integer('leaves_taken')->nullable();
            $table->float('gross_salary',8,2);
            $table->float('basic_salary',8,2);
            $table->float('hra',8,2);
            $table->float('fix_conveyance',8,2);
            $table->float('medical_allowance',8,2);
            $table->float('internet_allowance',8,2);
            $table->float('telephone',8,2);
            $table->float('prof_development',8,2);
			$table->float('special_allowance',8,2)->nullable();
            $table->float('employee_provident_fund',8,2);
            $table->float('employer_provident_fund',8,2);
            $table->float('tds',8,2)->nullable();
            $table->float('professional_tax',8,2);
            $table->float('other_deduction',8,2)->nullable();
            $table->float('net_salary',8,2);
            $table->string('payslip_file')->nullable();           
            $table->enum('email_sent_status',['yes', 'no'])->default('no');
            
            $table->timestamps();
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payslips');
    }
}
