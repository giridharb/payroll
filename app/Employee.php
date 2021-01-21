<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{

    protected $appends = ['full_name','employee_id'];
	protected $dates= ['date_of_birth','date_of_joining'];
	
    protected $fillable = [
        'first_name','middle_name','last_name',
        'date_of_birth','gender','date_of_joining',
        'primary_phone','secondary_phone','email_address',
        'designation_id','reporting_manager_id',
    ];


    public function getFullNameAttribute() {
        return ucfirst($this->first_name) . ' ' . ucfirst($this->last_name);
    }

    public function getEmployeeIdAttribute() {
        return "HL".str_pad($this->id,5,"0",STR_PAD_LEFT);
    }

    function designation(){
        return $this->belongsTo('App\Role','designation_id');
    }

    function manager(){
        return $this->belongsTo('App\Employee','reporting_manager_id');
    }

    function salary(){
        return $this->hasOne('App\Salary'); 
    }

    function payslips(){
        return $this->hasOne('App\Payslip'); 
    }

    function removeOldPhoto($oldPhoto){
         // Remove old photo
         $image_path = public_path()."/profile_images/$oldPhoto";
         
         if($oldPhoto=!" " && file_exists($image_path)){
             unlink($image_path);
         }
    }
}
