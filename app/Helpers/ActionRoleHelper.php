<?php

use Illuminate\Support\Facades\Session;

if (!function_exists('actionRole')) {
    function actionRole($subMenu,$action) {
        foreach (Session::get('menu') as $v) {
            foreach ($v->menu_sub as $m){
                if(strtoupper($m->sub_menu_label)==strtoupper($subMenu)){
                    if(in_array($action,explode(",",$m->action))){
                       return true;
                    }
                }
            }
        }

        return false;

    }
}
