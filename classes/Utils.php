<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Utils
 *
 * @author sixs
 */
class Utils {
    
    static function reverse_date($mod)
    {
        if($mod == 0 || $mod == null || $mod == ""){
            return ("0000-00-00");
        }else{
            $date1 = NULL;
            if($mod != null AND $mod != "" AND $mod != "0000-00-00"){
                  $array = explode("-", $mod);
                  for ($i = 2; $i >= 0; $i--){
                      $date1 .= $array[$i];
                      if ( $i >=1){
                            $date1 .= '-';
                      }
                  }
                  return ($date1);
            }
        }
    }
    
    static function time_no_sec($time)
    {
        if($time == "0" || $time == null || $time == ""){
            return ("");
        }else{
            $time_no_sec = null;
            $temp = explode(":", $time);
            $time_no_sec .= $temp[0];
            $time_no_sec .= ":";
            $time_no_sec .= $temp[1];
        }
        return $time_no_sec;
    }
    
    static function getGGFromInt($num_gg)
    {
        switch ($num_gg)
        {
            case "0":
                return "LUNEDI";
                break;
            case "1":
                return "MARTEDI";
                break;
            case "2":
                return "MERCOLEDI";
                break;
            case "3":
                return "GIOVEDI";
                break;
            case "4":
                return "VENERDI";
                break;
            case "5":
                return "SABATO";
                break;
            case "6":
                return "DOMENICA";
                break;
            default :
                return "";
        }
    }

}
