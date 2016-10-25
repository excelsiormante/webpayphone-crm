<?php

namespace App\Http\Controllers;

use DB,Input,Session,Redirect;
use App\Http\Controllers\Controller;

class APICredentialController extends Controller {
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
                Session::put('userdata', $userdata);
                Common::add_audit_log($userdata->user_id, "Login", "User Login", "creds/login");
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
    
    public function edit_user() {
        $return = array(
                    "result" => config('constants.RESULT_INITIAL')
                );
        try {
            $query = "SELECT pgc_halo.fn_add_admin_user(?,?,?,?,?,?,?)";
            $values = array(
                        'password'      => "admin",
                        'usertype_id'   => 1,
                        'fullname'      => "admin",
                        'username'      => "admin",
                        'email_address' => "admin@admin.com",
                        'status'        => 0,
                        'user_id'       => 0
                    );
            DB::select($query, $values);
        } catch (Exception $exc) {
            $return = array(
                        "result" => config('constants.RESULT_ERROR'),
                        "message" => $exc->getMessage()
                    );
        }
        echo json_encode($return);
    }
    
    public function add_user_type() {
        $return = array(
                    "result" => config('constants.RESULT_INITIAL')
                );
        try {
            $query = "SELECT pgc_halo.fn_add_admin_user(?)";
            $values = array(
                                'usertype' => "Admin",
                            );
            DB::select($query, $values);
        } catch (Exception $exc) {
            $return = array(
                        "result" => config('constants.RESULT_ERROR'),
                        "message" => $exc->getMessage()
                    );
        }
        echo json_encode($return);
    }
    
    public function edit_permissions() {
        $return = array(
                    "result" => config('constants.RESULT_INITIAL')
                );
        try {
            DB::transaction(function () {
                $query = "SELECT pgc_halo.fn_edit_permission(?)";
                $values = array(
                                    'usertype_id' => 1,
                                    'module_name' => "Users",
                                    'permissions' => "/user/add",
                                    'is_valid'    => true
                                );
                DB::select($query, $values);
            });
        } catch (Exception $exc) {
            $return = array(
                        "result" => config('constants.RESULT_ERROR'),
                        "message" => $exc->getMessage()
                    );
        }
        echo json_encode($return);
    }
    
    public function get_admin_users() {
        $return = array(
            "result" => config('constants.RESULT_INITIAL')
        );
        try {
            $query = "SELECT pgc_halo.fn_get_admin_users(?,?,?)
                      RESULT (user_id integer, username varchar, full_name varchar, user_type_id integer, email_address varchar, status integer);";
            
            $values = array(
                                'search' => "admin",
                                'limit'  => 10,
                                'offset' => 0
                            );
            DB::select($query, $values);
        } catch (Exception $exc) {
            $return = array(
                        "result" => config('constants.RESULT_ERROR'),
                        "message" => $exc->getMessage()
                    );
        }
        echo json_encode($return);
    }
    
    public function get_admin_user_desc() {
        $return = array(
            "result" => config('constants.RESULT_INITIAL')
        );
        try {
            $query = "SELECT pgc_halo.fn_get_admin_user_desc(?)
                      RESULT (user_id integer, username varchar, full_name varchar, user_type character varying, email_address varchar, status integer);";
            
            $values = array(
                                'user_id' => 1
                            );
            DB::select($query, $values);
        } catch (Exception $exc) {
            $return = array(
                        "result" => config('constants.RESULT_ERROR'),
                        "message" => $exc->getMessage()
                    );
        }
        echo json_encode($return);
    }
}

