<?php

namespace App\Http\Controllers;


use App\User;
use Request, Session, DB, Validator, Input, Redirect;
use App\Http\Controllers\Controller;

class SubscribersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subscribers = array();
        try {
            $query = "SELECT * FROM pgc_halo.fn_get_subscribers()
                      RESULT (subscriber_id integer, username varchar, user_type varchar, date_created timestamp, status integer);";
            $result = DB::select($query);
            
            if ( count($result) > 0 ) {
                foreach ($result as $value) {
                    $status = Common::get_status($value->status);
                    $subscriber = array(
                                    'id'           => $value->subscriber_id,
                                    'username'     => $value->username,
                                    'user_type'    => $value->user_type,
                                    'date_created' => $value->date_created,
                                    'status'       => $status['label']
                                );
                    array_push($subscribers, $subscriber);
                }
            }
        } catch (Exception $exc) {
            
        }
        return json_encode($subscribers);
    }


     public function showIndex()
    {
        return view('admin.subscribers');
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


        $subscriber = new User(Request::all());
        $subscriber->setConnection('pgsql2');
        $subscriber->save();

        return $subscriber;
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
            $query = "SELECT * FROM pgc_halo.fn_get_subscriber_desc(?)
                      RESULT (subscriber_id integer, username varchar, user_type character varying, ewallet float, firstname character varying, middlename character varying, lastname character varying, address character varying, bdate date, email_address character varying, status integer);";
            
            $values = array($id);
            $result = DB::select($query, $values);
            $result[0]->status = Common::get_status($result[0]->status);
            
            $return = array(
                    "result"   => config('constants.RESULT_SUCCESS'),
                    "data"     => $result[0],
                    "statuses" => config('constants.STATUS')
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


        $subscriber = User::on('pgsql2')->find($id);
        $subscriber->update(Request::all());
        $subscriber->save();
 
        /*
        $chief_id = Session::get('chief_user_id', 'default');
        $chief = Request::input('ChiefID');
        $action = 'Updated an Objective: "' . Request::input('ChiefObjectiveName') . '"';


        DB::insert('insert into audit_trails (Action, UserUnitID, UnitID) values (?,?,?)', array($action, $chief_id, $chief));

        DB::insert('insert into chief_audit_trails (Action, UserChiefID, ChiefID) values (?,?,?)', array($action, $chief_id, $chief));
        */

        return $subscriber;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        User::on('pgsql2')->destroy($id);
    }
}
