<?php

namespace App\Http\Controllers;


use App\User;
use Request, Session, DB, Validator, Input, Redirect;
use App\Http\Controllers\Controller;

class UsergroupsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usergroups = array();
        try {
            $query = "SELECT * FROM pgc_halo.fn_get_user_types()
                      RESULT (user_type_id integer, user_type varchar, description varchar, status integer);";
            $result = DB::select($query);
            dd($result);
            if ( count($result) > 0 ) {
                foreach ($result as $value) {
                    $usergroup = array(
                                    'id'    => $value->user_type_id,
                                    'groupname'   => $value->user_type,
                                    'description' => $value->description,
                                    'status'      => $value->status
                                );
                    array_push($usergroups, $usergroup);
                }
            }
        } catch (Exception $exc) {
            
        }
        return json_encode($usergroups);
    }


     public function showIndex()
    {
        return view('admin.usergroups');
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
            $query = "SELECT pgc_halo.fn_add_admin_user_type(?,?,?,?) as is_added;";
            $groupname = Input::get('groupname');
            $description = Input::get('description');
            $values = array($groupname, $description, 0, 0);
            $result = DB::select($query, $values);
            if ( $result[0]->is_added === TRUE ) {
                $return = array(
                    "result"  => config('constants.RESULT_SUCCESS'),
                    "message" => "User Group successfully added."
                );
            } else {
                $return = array(
                    "result" => config('constants.RESULT_ERROR'),
                    "message" => "User Group already exist."
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
        $usergroup = array();
        try {
            $query = "SELECT * FROM pgc_halo.fn_get_user_type(?)
                      RESULT (user_type_id integer, user_type varchar, description varchar, status integer);";
            $values = array((int)$id);
            $result = DB::select($query,$values);
            if ( count($result) > 0 ) {
                $usergroup = array(
                                'id'          => $result[0]->user_type_id,
                                'groupname'   => $result[0]->user_type,
                                'description' => $result[0]->description,
                                'status'      => $result[0]->status
                            );
                
            }
        } catch (Exception $exc) {
            
        }
        return json_encode($usergroup);
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
            $query = "SELECT pgc_halo.fn_add_admin_user_type(?,?,?,?) as is_added;";
            $groupname   = Input::get('groupname');
            $description = Input::get('description');
            $status      = Input::get('status');
            $values = array($groupname, $description, (int)$id, $status);
            $result = DB::select($query, $values);
            if ( $result[0]->is_added === TRUE ) {
                $return = array(
                    "result"  => config('constants.RESULT_SUCCESS'),
                    "message" => "User Group successfully updated."
                );
            } else {
                $return = array(
                    "result" => config('constants.RESULT_ERROR'),
                    "message" => "User Group update failed."
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
