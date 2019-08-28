<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace common\helpers;

/**
 * Description of HelpersFunctions
 *
 * @author Вадим
 */

class HelpersFunctions 
{    
    public static function arrForList($arr = array())
    {
        $new_arr = array();
        foreach($arr as $key => $value){
            $new_arr[$key] = $value['title'];
        }
        return $new_arr;
    }
    
    public static function idList($arr = array())
    {
        $new_arr = array();
        foreach($arr as $key => $value){
            $new_arr[$key] = $value['id'];
        }
        return $new_arr;
    }
    
    public static function arrForEnginesList($arr = array(), $car_title = '')
    {
        $new_arr = array();
        foreach($arr as $key => $value){
            $new_arr[$key] = $car_title . ' ' . $value['generation']['alter_title'] . ' ' . $value['title'];
        }
        return $new_arr;
    }
    
    public static function arrForObjectList($arr = array())
    {
        $new_arr = array();
        foreach($arr as $key => $value){
            $new_arr[] = $value->id;
        }
        return $new_arr;
    }
}
