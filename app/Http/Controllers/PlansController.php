<?php

namespace App\Http\Controllers;


use App\Plan;
use Request, Session, DB, Validator, Input, Redirect;
use App\Http\Controllers\Controller;

class PlansController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */

    public function index()
    {
        $plans = array();
        try {
            $query = "SELECT * FROM pgc_halo.fn_get_products()
                      RESULT (product_id integer, code varchar, name varchar, description varchar, price float, product_type varchar, call_duration integer, nominations integer, plan_duration integer, status integer);";
            $result = DB::select($query);
            if ( count($result) > 0 ) {
                foreach ($result as $value) {
                    $call_duration_total = floor($value['call_duration'] / 60);
                    $call_duration_minutes = floor($call_duration_total % 60);
                    $call_duration_hours = floor($call_duration_total % 24);
                    $call_duration_days = floor($call_duration_total / 24);
                    
                    $plan_duration_total = floor($value['call_duration'] / 60);
                    $plan_duration_minutes = floor($plan_duration_total % 60);
                    $plan_duration_hours = floor($plan_duration_total % 24);
                    $plan_duration_days = floor($plan_duration_total / 24);
                    
                    
                    $plan = array(
                                'id'              => $value->product_id,
                                'code'            => $value->code,
                                'name'            => $value->name,
                                'description'     => $value->description,
                                'type'            => $value->product_type,
                                'nominations'     => $value->status,
                                'price'           => $value->price,
                                'airtime_days'    => $call_duration_days,
                                'airtime_hours'   => $call_duration_hours,
                                'airtime_minutes' => $call_duration_minutes,
                                'plan_days'       => $plan_duration_days,
                                'plan_hours'      => $plan_duration_hours,
                                'plan_minutes'    => $plan_duration_minutes
                            );
                    array_push($plans, $plan);
                }
            }
        } catch (Exception $exc) {
            
        }
        return json_encode($plans);
    }

    
    public function showIndex()
    {
        return view('admin.plans');
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

        

        $plan = new Plan(Request::all());
        $plan->save();

        return $plan;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) 
    {
        $plan = Plan::find($id);
        
        
        return $plan;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {


        $plan = Plan::find($id);
        $plan->update(Request::all());
        $plan->save();
 
        /*
        $chief_id = Session::get('chief_user_id', 'default');
        $chief = Request::input('ChiefID');
        $action = 'Updated an Objective: "' . Request::input('ChiefObjectiveName') . '"';


        DB::insert('insert into audit_trails (Action, UserUnitID, UnitID) values (?,?,?)', array($action, $chief_id, $chief));

        DB::insert('insert into chief_audit_trails (Action, UserChiefID, ChiefID) values (?,?,?)', array($action, $chief_id, $chief));
        */


        return $plan;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        Plan::destroy($id);
    }
}
