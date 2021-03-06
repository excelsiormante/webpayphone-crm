<?php

namespace App\Http\Controllers;

use DB;
use App\Http\Controllers\Controller;

class Common {
    public static function add_audit_log($user_id, $module_name, $description, $link) {
        $query = "SELECT pgc_halo.fn_log(?,?,?,?);";
        
        $values = array($user_id,$module_name,$description,$link);
        
        DB::select($query, $values);
    }
    
    public static function get_active_user_types() {
        $query = "SELECT * FROM pgc_halo.fn_get_active_user_types()
                  RESULT (value integer, label varchar);";
        
        return DB::select($query);
    }
    
    public static function my_user_type($id, $user_types) {
        $return = false;
        foreach ($user_types as $value) {
            if ( $id == $user_types->value ) {
                $return = $value;
                break;
            }
        }
        return $return;
    }
    
    public static function get_status($status_id){
        $return = false;
        foreach (config('constants.STATUS') as $value) {
            if ( $status_id == $value['value'] ) {
                $return = $value;
                break;
            }
        }
        return $return;
    }
}