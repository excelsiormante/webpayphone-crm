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
        $data = Plan::all();

        foreach($data as $key => $datum)
        {
            $seconds = floor($datum['airtime_duration'] % 60);
            $total = floor($datum['airtime_duration'] / 60);
            $minutes = floor($total % 60);
            $total = floor($total/60);
            $hours = floor($total % 24);
            $days = floor($total / 24);
            $data[$key]['airtime_days'] = $days;
            $data[$key]['airtime_hours'] = $hours;
            $data[$key]['airtime_minutes'] = $minutes;
            $data[$key]['airtime_seconds'] = $seconds; 

            $seconds = floor($datum['plan_duration'] % 60);
            $total = floor($datum['plan_duration'] / 60);
            $minutes = floor($total % 60);
            $total = floor($total/60);
            $hours = floor($total % 24);
            $days = floor($total / 24);
            $data[$key]['plan_days'] = $days;
            $data[$key]['plan_hours'] = $hours;
            $data[$key]['plan_minutes'] = $minutes;
            $data[$key]['plan_seconds'] = $seconds; 

        }

        return json_encode($data);
    }

    
    public function showIndex()
    {
        
            $plans = Plan::all();
            return view('admin.plans')
                ->with('plans', $plans);
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
