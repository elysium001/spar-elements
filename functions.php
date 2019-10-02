<?php

// Prepares js object from shortcode size options.
function parse_arr( $size_arr ){
    $size_arr = explode(',',$size_arr);
    $final_arr = array();
    foreach ($size_arr as $properties ) {
        $prop = explode(':', $properties);
        $value = $prop[1] === 'true' ? true: $prop[1] === 'false' ? false:$prop[1];
        $final_arr[$prop[0]] = $value;
    }
    return $final_arr;
}

// Match img tags.
function img_arr_filter( $arr_item ){
    return preg_match('/(<img[^>]+\>)/i', $arr_item);
}