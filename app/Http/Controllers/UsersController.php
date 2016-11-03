<?php

namespace App\Http\Controllers;


use App\User;
use Request, Session, DB, Validator, Input, Redirect;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = array();
        try {
            $query = "SELECT * FROM pgc_halo.fn_get_admin_users()
                      RESULT (id integer, username varchar, fullname varchar, usergroup integer , email varchar, status integer);";
            $result = DB::select($query);
            if ( count($result) > 0 ) {
                foreach ($result as $value) {
                    $user = array(
                                    'id'    => $value->id,
                                    'username'   => $value->username,
                                    'fullname' => $value->fullname,
                                    'usergroup' => $value->usergroup,
                                    'email' => $value->email,
                                    'status'      => $value->status
                                );

                    array_push($users, $user);
                }
            }
        } catch (Exception $exc) {
            
        }
        return json_encode($result);
    }


     public function showIndex()
    {
            return view('admin.users');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $return = array(
                    "result" => config('constants.RESULT_INITIAL'),
                    "message" => ""
                );
        try {
            $query = "SELECT pgc_halo.fn_edit_admin_user(?,?,?,?,?,?,?) as is_added;";
            $username = Input::get('username');
            $fullname = Input::get('fullname');
            $email = Input::get('email');
            $usergroup = Input::get('usergroup');
            $password = Input::get('password');
            $values = array($password,$usergroup, $fullname, $username, $email, 0, 0);
            $result = DB::select($query, $values);
            if ( $result[0]->is_added === TRUE ) {
                $return = array(
                    "result"  => config('constants.RESULT_SUCCESS'),
                    "message" => "User Group successfully added."
                );
            } else {
                $return = array(
                    "result" => config('constants.RESULT_ERROR'),
                    "message" => "User already exist."
                );
            }
        } catch (Exception $exc) {
                $return = array(
                    "result" => config('constants.RESULT_ERROR'),
                    "message" => $exc->getMessage()
                );
        }
        echo json_encode($return);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) 
    {
        $return = array(
            "result" => config('constants.RESULT_INITIAL')
        );
        try {
            $query = "SELECT * FROM pgc_halo.fn_get_admin_user_desc(?)
                      RESULT (id integer, username varchar, fullname varchar, usergroup integer , email varchar, status integer);";
            $values = array((int)$id);
            $result = DB::select($query, $values);
            $result[0]->status = Common::get_status($result[0]->status);
            $result[0]->usergroup = Common::get_status($result[0]->usergroup);
            $user_types = Common::get_active_user_types();
            
            $return = array(
                    "result"     => config('constants.RESULT_SUCCESS'),
                    "data"       => $result[0],
                    "statuses"   => config('constants.STATUS'),
                    "user_types" => $user_types
                );
        } catch (Exception $exc) {
            $return = array(
                        "result" => config('constants.RESULT_ERROR'),
                        "message" => $exc->getMessage()
                    );
        }
        return json_encode($return);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $return = array(
                    "result" => config('constants.RESULT_INITIAL'),
                    "message" => ""
                );
        try {
            $query = "SELECT pgc_halo.fn_edit_admin_user(?,?,?,?,?,?) as is_added;";
            $username   = Input::get('username');
            $email      = Input::get('email');
            $fullname = Input::get('fullname');
            $usergroup = Input::get('usergroup');
            $status = Input::get('status');
            $values = array($usergroup['value'], $fullname, $username, $email, $status['value'], (int)$id);
            $result = DB::select($query, $values);
            if ( $result[0]->is_added === TRUE ) {
                $return = array(
                    "result"  => config('constants.RESULT_SUCCESS'),
                    "message" => "User successfully updated."
                );
            } else {
                $return = array(
                    "result" => config('constants.RESULT_ERROR'),
                    "message" => "User update failed."
                );
            }
        } catch (Exception $exc) {
                $return = array(
                    "result" => config('constants.RESULT_ERROR'),
                    "message" => $exc->getMessage()
                );
        }
        echo json_encode($return);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        
    }
}
