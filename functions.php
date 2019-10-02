<?php

// Prepares js object from shortcode size options.
function parse_arr( $size_arr, $preserve = false){
    $size_arr = explode(',',$size_arr);
    $final_arr = array();
    foreach ($size_arr as $properties ) {
        $prop = explode(':', $properties);

        if( !$preserve ){
            $value = $prop[1] === 'true' ? true: $prop[1] === 'false' ? false:$prop[1];
        }else {
            $value = $prop[1];
        }

        $final_arr[$prop[0]] = $value;
    }
    return $final_arr;
}

// Match img tags.
function img_arr_filter( $arr_item ){
    return preg_match('/(<img[^>]+\>)/i', $arr_item);
}

/**
 * Only supports split by newline and img tags at the moment.
 * 
 * TODO: Add more tags to split by.
 */
function split_content( $split, $content ){
    $content_items;
    switch ($split) {
        case 'img':
            $content_items = preg_split('/(<img[^>]+\>)/i', $content, -1, PREG_SPLIT_DELIM_CAPTURE);
            $content_items = array_filter($content_items, 'img_arr_filter');
            break;
        default:
            $content_items = preg_split('/\r\n|\r|\n/', $content);				
            break;
    }
    return $content_items;
}