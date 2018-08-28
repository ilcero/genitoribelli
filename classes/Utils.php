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

}
