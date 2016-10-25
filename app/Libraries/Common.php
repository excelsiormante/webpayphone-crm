<?php

namespace App\Http\Controllers;

use DB;
use App\Http\Controllers\Controller;

class Common {
    public static function add_audit_log($user_id, $module_name, $description, $link) {
        $query = "SELECT pgc_halo.fn_log(?,?,?,?);";
        
        $values = array(
                            'user_id'     => $user_id,
                            'module_name' => $module_name,
                            'description' => $description,
                            'link'        => $link
                        );
        
        DB::select($query, $values);
    }
}