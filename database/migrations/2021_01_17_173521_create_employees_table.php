<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned()->index()->nullable();           
            $table->string('first_name',50);
            $table->string('middle_name',50)->nullable();
            $table->string('last_name',50); 
            $table->date('date_of_birth');
            $table->enum('gender',['male', 'female']);
            $table->date('date_of_joining');
            $table->string('primary_phone',15); 
            $table->string('secondary_phone',15)->nullable();            
            $table->string('email_address')->unique();
            $table->string('photo')->nullable();          
            $table->bigInteger('designation_id')->unsigned()->index();
            $table->bigInteger('reporting_manager_id')->unsigned()->index()->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('designation_id')->references('id')->on('roles')->onDelete('cascade');
            $table->foreign('reporting_manager_id')->references('id')->on('employees')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
