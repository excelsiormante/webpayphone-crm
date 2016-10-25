<?php

namespace App\Http\Controllers;

use DB;
use App\Http\Controllers\Controller;

class APIProductController extends Controller {
    public function edit_product(){
        $return = array(
            "result" => config('constants.RESULT_INITIAL')
        );
        try {
            $query = "SELECT pgc_halo.fn_edit_product(?,?,?,?,?,?,?,?,?);";
            
            $values = array(
                                'code'          => "PLAN999",
                                'name'          => "plan",
                                'description'   => "plan 999",
                                'price'         => 20.00,
                                'product_type'  => "UNLI",
                                'call_duration' => 3600,
                                'nominations'   => 2,
                                'plan_duration' => 30,
                                'product_id'    => 0
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
    
    public function get_products() {
        $return = array(
            "result" => config('constants.RESULT_INITIAL')
        );
        try {
            $query = "SELECT pgc_halo.fn_get_products(?,?,?)
                      RESULT (product_id integer, code varchar, name varchar, description varchar, price float, product_type varchar, call_duration integer, nominations integer, plan_duration integer, status integer);";
            
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
    
    public function get_product_desc() {
        $return = array(
            "result" => config('constants.RESULT_INITIAL')
        );
        try {
            $query = "SELECT pgc_halo.fn_get_product_desc(?)
                      RESULT (product_id integer, code varchar, name varchar, description varchar, price float, product_type varchar, call_duration integer, nominations integer, plan_duration integer, status integer);";
            
            $values = array(
                                'product_id' => 1
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