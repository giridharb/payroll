<?php

namespace App\Mail;

use App\Payslip;
use App\Employee;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PayslipGenerated extends Mailable
{
    use Queueable, SerializesModels;

	public $payslip;
	public $employee;
	
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Payslip $payslip, Employee $employee)
    {
        $this->payslip  = $payslip;
		$this->employee = $employee;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $fileName = $this->employee->employee_id.'-'.$this->payslip->month_of_pay->format("F-Y").".pdf";
		
		$subject = "Payslip for ".$this->payslip->month_of_pay->format("F,Y");
		return $this->subject($subject)->markdown('emails.payslip')->attach(storage_path('payslips/'.$fileName), [
                    'as' => $fileName,
                    'mime' => 'application/pdf',
                ]);
    }
}
