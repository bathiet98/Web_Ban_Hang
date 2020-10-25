<?php

namespace App\Services;

class ProcessViewService
{
    public static function view($table,$column,$key,$id)
    {
        $ipAddress  = get_client_ip();
        $timeNow    = time();
        //let the views expire after one hour
        $throttleTime   = 1 * 2 ;
        $key            = $key .'_'. md5($ipAddress).'_'.$id;
        if (\Session::exists($key)){
            $timeBefore = \Session::get($key);
            if ($timeBefore + $throttleTime > $timeNow){
                return false;
            }
        }
        \Session::put($key,$timeNow);
        \DB::table($table)->where('id',$id)
                            -> increment($column);
    }
}
