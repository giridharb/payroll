<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use App\User;
class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
		$maleCount = Employee::where('gender','male')->count();
		$femaleCount = Employee::where('gender','female')->count();
		$totalEmployeeCount = Employee::count();
		$totalUserCount = User::count();
        return view('dashboard',['maleCount'=>$maleCount,'femaleCount'=>$femaleCount,'totalEmployeeCount'=>$totalEmployeeCount,'totalUserCount'=>$totalUserCount]);
    }
}
