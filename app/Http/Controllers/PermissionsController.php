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
    }


    public function showIndex(){
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
        return view('admin.permissions')
                ->with('permissions', $permission)
                ->with('usergroups', $usergroups);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {

        /*
        $admin_id = Session::get('aid', 'default');
        $action = 'Added a plan "' . Request::input('plan_name') . '"';


        DB::insert('insert into audit_trails (Action, UserUnitID, UnitID) values (?,?,?)', array($action, $chief_id, $chief));

        DB::insert('insert into chief_audit_trails (Action, UserChiefID, ChiefID) values (?,?,?)', array($action, $chief_id, $chief));
        */

/*
        $subscriber = new User(Request::all());
        $subscriber->setConnection('pgsql2');
        $subscriber->save();

        return $subscriber; */
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) 
    {
     /*   $subscriber = User::on('pgsql2')->find($id);
        
        
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


     /*   $subscriber = User::on('pgsql2')->find($id);
        $subscriber->update(Request::all());
        $subscriber->save();
 
        
        $chief_id = Session::get('chief_user_id', 'default');
        $chief = Request::input('ChiefID');
        $action = 'Updated an Objective: "' . Request::input('ChiefObjectiveName') . '"';


        DB::insert('insert into audit_trails (Action, UserUnitID, UnitID) values (?,?,?)', array($action, $chief_id, $chief));

        DB::insert('insert into chief_audit_trails (Action, UserChiefID, ChiefID) values (?,?,?)', array($action, $chief_id, $chief));
        

        return $subscriber; */
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
