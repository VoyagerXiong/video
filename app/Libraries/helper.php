<?php
/**
 * Created by PhpStorm.
 * User: Aubrey.Xiong
 * Date: 2017/11/21
 * Time: 16:28
 */
function p($var){
    echo '<pre style="background: #dddddd;padding: 10px;border: 1px solid #cccccc;border-radius: 4px;">';
    if(is_null($var) || is_bool($var)){
        var_dump($var);
    }else{
        if(is_object($var)){
            print_r($var->toArray());
        }else{
            print_r($var);
        }
    }
    echo '</pre>';
}

function mycut($var,$num){
    if(mb_strlen($var,'utf8')>$num){
        $data = mb_substr($var,0,$num,'utf8').'...';
    }else{
        $data = $var;
    }
    echo $data;
}