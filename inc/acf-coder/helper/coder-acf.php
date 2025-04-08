<?php
/***
ACF Extend
v 1.0
***/

function cif_img($key){
    $img = get_field($key);
    if(!empty($img)){
        echo '<img src="'.$img['url'].'" alt="">';
    }
}
function cisf_img($key){
    $img = get_sub_field($key);
    if(!empty($img)){
        echo '<img src="'.$img['url'].'" alt="">';
    }
}
