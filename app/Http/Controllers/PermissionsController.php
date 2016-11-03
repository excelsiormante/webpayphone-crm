<?php

namespace App\Http\Controllers;


use App\User;
use Request, Session, DB, Validator, Input, Redirect;
use App\Http\Controllers\Controller;

class PermissionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $return = array();
        $permissions = array();
        $usergroups  = array();
        try {
            $query = "SELECT * FROM pgc_halo.fn_get_user_types()
                      RESULT (user_type_id integer, user_type varchar, description varchar, status integer);";
            $result = DB::select($query);
            if ( count($result) > 0 ) {
                foreach ($result as $value) {
                    if ( $value->status === config('constants.STATUS_ACTIVE') ) {
                        $usergroup = array(
                                        'id'        => $value->user_type_id,
                                        'groupname' => $value->user_type
                                    );
                        array_push($usergroups, $usergroup);
                    }
                }
            }

            $query = "SELECT * FROM pgc_halo.fn_get_permissions(?)
                      RESULT (user_type_id integer, module_name varchar, permission varchar, is_valid boolean);";

            $value = array(1);
            $result = DB::select($query,$value);
            if ( count($result) > 0 ) {
                foreach ($result as $value) {
                    $permission = array(
                                    'permission' => $value->permission,
                                    'html_name'  => strtolower($value->module_name . "_" .$value->permission),
                                    'is_valid'   => $value->is_valid
                                );
                    if ( !isset($permissions[$value->module_name]) ) {
                        $permissions[$value->module_name] = array();
                    }
                    array_push($permissions[$value->module_name], $permission);
                }
            }
        } catch (Exception $exc) {

        }
        $return['permissions'] = json_encode($permissions);
        $return['usergroups'] = json_encode($usergroups);
        return json_encode($return);
    }


    public function showIndex(){
        return view('admin.permissions');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) 
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $permissions = Input::get('permissions');
        
        $return = array(
                    "result" => config('constants.RESULT_INITIAL')
                );
        try {
            DB::transaction(function () use ($id, $permissions) {
                $query = "SELECT pgc_halo.fn_edit_permission(?,?,?,?);";
                foreach ($permissions as $key => $description) {
                    foreach ($description as $value) {
                        $permission = $value['permission'];
                        $is_valid   = $value['is_valid'];
                        $values = array($id,$key,$permission,$is_valid);
                        DB::select($query, $values);
                    }

                }
            });
            $return = array(
                    "result"  => config('constants.RESULT_SUCCESS'),
                    "message" => "Permission successfully updated."
                );
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
