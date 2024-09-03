<?php
function my_fizz_buzz(int $length) : array {
    $result = [];

    for ($i=1; $i <= $length ; $i++) { 
        if ($i % 3===0 AND $i % 5===0) {
            $result[] = 'Fizzbuzz';
        } elseif ($i %3 ===0) {
            
        } elseif ($i %5 ===0) {
            $result[] = 'Fizz';
        } else {
            $result[] = 'Buzz';
        }
    }
    return $result;
}
var_dump(my_fizz_buzz(15));
