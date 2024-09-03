<?php
function my_closest_to_zero(array $array) : int {

    $closest = $array[0];

    foreach ($array as $number) {
        if (abs($number) < abs($closest) || (abs($number) == abs($closest) && $number > $closest)) {
            $closest = $number;
        }
    }
    return $closest;
}
var_dump(my_closest_to_zero([2, -1, 5, 23, 21, 9]));
var_dump(my_closest_to_zero([234, -142, 512, 1224, 451, -59]));
