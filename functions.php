<?php

function parse_arr( $size_arr ){
    $size_arr = explode(',',$size_arr);
    $final_arr = array();
    foreach ($size_arr as $properties ) {
        $prop = explode(':', $properties);
        $final_arr[$prop[0]] = $prop[1];
    }
    return $final_arr;
}