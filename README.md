## About Hartley Lab Payroll

Hartley Lab Payroll is a web application for employee Payroll Management System.

Following are the features provided:

- CRUD function on Employee/Role/Payroll model
- Earning and Deductions, based on employee
- Payroll Calculation using Payroll Generator
- E-mail / Preview the payslip for the employee
- Payroll Report for Employee
- Customisable earnings and deductions calculation process



## Installation

1. In order to install payroll project, just run the *git clone https://github.com/giridharb/payroll.git* command from your terminal

2. Go to project cloned directory and run following command:

```
$ composer install
$ php artisan key:generate
```

3. Create database and Copy .env.example file to .env and edit database credentials there

4. Next, You need to run following commands  from your terminal

```
$ php artisan migrate
$ php artisan db:seed
```

5. Finally, run following command  from your terminal to execute project

```
$ php artisan serve
```

## Login Credentials
email : hr@hlpayroll.com
password : Hlp@1234
