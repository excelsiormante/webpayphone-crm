<?php

namespace App\Http\Controllers;


use App\User;
use App\Http\Controllers\Controller;

class APISubscribersController extends Controller {    
    public function get_subscribers() {
        $return = array(
            "result" => config('constants.RESULT_INITIAL')
        );
        try {
            $query = "SELECT * FROM pgc_halo.fn_get_subscribers(?,?,?)
                      RESULT (subscriber_id integer, username varchar, subscriber_profile_id integer, user_type_id integer, status integer);";
            
            $values = array(
                                'search' => "plan",
                                'limit'  => 10,
                                'offset' => 0
                            );
            DB::select($query, $values);
        } catch (Exception $exc) {
            $return = array(
                        "result" => config('constants.RESULT_ERROR'),
                        "message" => $exc->getMessage()
                    );
        }
        echo json_encode($return);
    }
    
    public function get_subscriber_desc() {
        $return = array(
            "result" => config('constants.RESULT_INITIAL')
        );
        try {
            $query = "SELECT * FROM pgc_halo.fn_get_subscriber_desc(?)
                      RESULT (subscriber_id integer, username varchar, user_type character varying, firstname character varying, middlename character varying, lastname character varying, address character varying, bdate date, email_address character varying, status integer);";
            
            $values = array(
                                'subscriber_id' => 1
                            );
            DB::select($query, $values);
        } catch (Exception $exc) {
            $return = array(
                        "result" => config('constants.RESULT_ERROR'),
                        "message" => $exc->getMessage()
                    );
        }
        echo json_encode($return);
    }
    
    public function get_subscriptions() {
        $return = array(
            "result" => config('constants.RESULT_INITIAL')
        );
        try {
            $query = "SELECT * FROM pgc_halo.fn_get_subscriptions(?,?,?,?)
                      RESULT (subscription_id integer, username varchar, product varchar, date_created date, status integer);";
            
            $values = array(
                            'subscriber_id' => 1,
                            'product_id'    => 1,
                            'limit'         => 10,
                            'offset'        => 0,
                        );
            DB::select($query, $values);
        } catch (Exception $exc) {
            $return = array(
                        "result" => config('constants.RESULT_ERROR'),
                        "message" => $exc->getMessage()
                    );
        }
        echo json_encode($return);
    }
    
    public function get_subscription_desc() {
        $return = array(
            "result" => config('constants.RESULT_INITIAL')
        );
        try {
            $query = "SELECT * FROM pgc_halo.fn_get_subscriber_desc(?)
                      RESULT (subscription_id integer, subcriber_id integer, product_id integer, assigned_bnum text, username character varying, code character varying, name character varying, price float, product_type character varying, call_duration integer, nominations integer, plan_duration integer, status integer, date_created date);";
            
            $values = array(
                            'subscription_id' => 1
                        );
            DB::select($query, $values);
        } catch (Exception $exc) {
            $return = array(
                        "result" => config('constants.RESULT_ERROR'),
                        "message" => $exc->getMessage()
                    );
        }
        echo json_encode($return);
    }
}