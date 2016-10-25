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
        /* $data = User::on('pgsql2')->get();
        return json_encode($data); */
    }


     public function showIndex()
    {
        try {
            $data = array();
            $query = "SELECT * FROM pgc_halo.fn_get_user_types()
                      RESULT (user_type_id integer, user_type varchar, description varchar, status integer);";
            $result = DB::select($query);
            if ( count($result) > 0 ) {
                $usergroups = array();
                foreach ($result as $value) {
                    $usergroup = array(
                                    'group_id'    => $value->user_type_id,
                                    'usergroup'   => $value->user_type,
                                    'description' => $value->description,
                                    'status'      => $value->status
                                );
                }
            }
        } catch (Exception $exc) {
            
        }
        return view('admin.usergroups', $data);
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
            $query = "SELECT pgc_halo.fn_add_admin_user_type(?,?) as is_added;";
            $groupname = Input::get('groupname');
            $description = Input::get('description');
            $values = array($groupname, $description);
            $result = DB::select($query, $values);
            if ( $result->is_added == "t" ) {
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
       /* $subscriber = User::on('pgsql2')->find($id);
        
        
        return $subscriber; */
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
       /* User::on('pgsql2')->destroy($id); */
    }
}
