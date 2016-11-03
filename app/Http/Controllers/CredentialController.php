<?php

namespace App\Http\Controllers;

use DB,Input,Session,Redirect;
use App\Http\Controllers\Controller;

class CredentialController extends Controller {
    public function show_login(){
        $return = "";
        try {
            $hasLoggedIn = Session::has('userdata');
            if ( $hasLoggedIn ) {
                $return = Redirect::to('/');
            } else {
                $return = view('admin.login');
            }
        } catch (Exception $exc) {
            
        }
        return $return;
    }
    
    public function login(){
        $return = "";
        try {
            $username = Input::get('username');
            $password = Input::get('password');
            $query = "SELECT *  FROM pgc_halo.fn_admin_login(?,?)
                      RESULT (user_id integer, username varchar, full_name varchar, user_type_id integer, email_address varchar, status integer);";
            $values = array($username,$password);
            $result = DB::select($query, $values);
            if ( count($result) > 0 ) {
                // Saved User data session
                $userdata = $result[0];
                Common::add_audit_log($userdata->user_id, "Login", "User Login", "creds/login");
                Session::put('userdata', $userdata);
                // Redirect to dashboard
                $return = Redirect::to('/');
            } else {
                $return = Redirect::to('creds/login')->with('messageText','Invalid Username/Password.');
            }
        } catch (Exception $exc) {
            
        }
        return $return;
    }
    
    public function logout(){
        try {
            $hasLoggedIn = Session::has('userdata');
            if ( $hasLoggedIn ) {
                $userdata = Session::get('userdata');
                Common::add_audit_log($userdata->user_id, "Login", "User Logout", "creds/login");
                Session::flush();
            }
        } catch (Exception $exc) {
            
        }
        return Redirect::to('creds/login');
    }
}

