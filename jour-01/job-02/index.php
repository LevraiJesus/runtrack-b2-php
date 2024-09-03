<?php
function my_str_reverse(string $string) : string {
    $inversement = '';

    for ($i = strlen($string)-1; $i >= 0; $i--){
        $inversement.= $string[$i];
    } 
    return $inversement;
}
var_dump(my_str_reverse('hello'));




