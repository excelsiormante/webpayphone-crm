<?php namespace App\Http\Controllers;

//MODELS
use App\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator, Input, Redirect, Session, DB;

class DashboardController extends Controller {


	public function showDashboard()
	{

		return view('admin.dashboard');
	}
}
