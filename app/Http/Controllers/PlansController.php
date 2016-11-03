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
                      RESULT (id integer, code varchar, name varchar, description text, price float, product_type varchar, call_duration varchar, nominations integer, plan_duration varchar, status integer);";
            $result = DB::select($query);
            if ( count($result) > 0 ) {
                foreach ($result as $value) {
                    $call_duration_total = $value->call_duration;
                    $call_duration_total = $call_duration_total / 60;
                    $call_duration_minutes = floor($call_duration_total % 60);   
                    $call_duration_total = $call_duration_total / 60;
                    $call_duration_hours = floor($call_duration_total % 24);
                    $call_duration_days = floor($call_duration_total / 24);

                    
                    $plan_duration_total = $value->plan_duration;
                    $plan_duration_total = $plan_duration_total / 60;
                    $plan_duration_minutes = floor($plan_duration_total % 60);   
                    $plan_duration_total = $plan_duration_total / 60;
                    $plan_duration_hours = floor($plan_duration_total % 24);
                    $plan_duration_days = floor($plan_duration_total / 24);
                    
                    
                    $plan = array(
                                'id'              => $value->id,
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

        $return = array(
                    "result" => config('constants.RESULT_INITIAL'),
                    "message" => ""
                );
        try {
            $query = "SELECT pgc_halo.fn_edit_product(?,?,?,?,?,?,?,?,?) as is_added;";
            $code = Input::get('code');
            $name = Input::get('name');
            $description = Input::get('description');
            $price = Input::get('price');
            $type = Input::get('type');
            $call_duration = Input::get('airtime_duration');
            $plan_duration = Input::get('plan_duration');
            $nominations = Input::get('nominations');
            $values = array($code, $name, $description, $price, $type, $call_duration, $plan_duration, $nominations, 0);
            $result = DB::select($query, $values);
            if ( $result[0]->is_added === TRUE ) {
                $return = array(
                    "result"  => config('constants.RESULT_SUCCESS'),
                    "message" => "Plan successfully added."
                );
            } else {
                $return = array(
                    "result" => config('constants.RESULT_ERROR'),
                    "message" => "Plan already exist."
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
        $plan = array();
        try {
            $query = "SELECT * FROM pgc_halo.fn_get_products(?)
                      RESULT (code varchar, name varchar, description varchar, price float, product_type varchar, call_duration integer, plan_duration integer, nominations integer);";
            $values = array((int)$id);
            $result = DB::select($query,$values);
            if ( count($result) > 0 ) {
                $plan = array(
                                'code'          => $result[0]->code,
                                'name'   => $result[0]->name,
                                'description' => $result[0]->description,
                                'price'      => $result[0]->price,
                                'type'  => $result[0]->product_type,
                                'airtime_duration' => $result[0]->call_duration,
                                'plan_duration' => $result[0]->plan_duration,
                                'nominations' => $result[0] ->nominations
                            );
                
            }
        } catch (Exception $exc) {
            
        }
        return json_encode($plan);
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
            $query = "SELECT pgc_halo.fn_edit_product(?,?,?,?,?,?,?,?,?) as is_added;";
            $code = Input::get('code');
            $name = Input::get('name');
            $description = Input::get('description');
            $price = Input::get('price');
            $type = Input::get('type');
            $call_duration = Input::get('airtime_duration');
            $plan_duration = Input::get('plan_duration');
            $nominations = Input::get('nominations');
            $values = array($code, $name, $description, $price, $type, $call_duration, $plan_duration, $nominations, $id);
            $result = DB::select($query, $values);
            if ( $result[0]->is_added === TRUE ) {
                $return = array(
                    "result"  => config('constants.RESULT_SUCCESS'),
                    "message" => "Plan successfully updated."
                );
            } else {
                $return = array(
                    "result" => config('constants.RESULT_ERROR'),
                    "message" => "Plan already exist."
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
