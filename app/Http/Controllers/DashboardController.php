<?php namespace App\Http\Controllers;

//MODELS
use App\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator, Input, Redirect, Session, DB;

class DashboardController extends Controller {


	public function showDashboard()
	{
            $return = "";
                $hasLoggedIn = Session::has('userdata');
                if ( $hasLoggedIn ) {
                    $return = view('admin.dashboard');
                } else {
                    $return = Redirect::to('creds/login');
                }
            return $return;
	}
}
