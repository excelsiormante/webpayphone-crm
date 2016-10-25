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
            $query = "SELECT *  FROM pgc_halo.fn_get_user_types()
                      RESULT (user_type_id integer, user_type varchar);";
            $result = DB::select($query);
            if ( count($result) > 0 ) {
                
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

        /*
        $subscriber = User::on('pgsql2')->find($id);
        $subscriber->update(Request::all());
        $subscriber->save();
 
        
        $chief_id = Session::get('chief_user_id', 'default');
        $chief = Request::input('ChiefID');
        $action = 'Updated an Objective: "' . Request::input('ChiefObjectiveName') . '"';


        DB::insert('insert into audit_trails (Action, UserUnitID, UnitID) values (?,?,?)', array($action, $chief_id, $chief));

        DB::insert('insert into chief_audit_trails (Action, UserChiefID, ChiefID) values (?,?,?)', array($action, $chief_id, $chief));
        

        return $subscriber;*/
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
