<?php
function my_str_search(string $haystack, string $needle): int {
    $count = 0;

    for ($i = 0; $i <strlen($haystack); $i++) {
        if ($haystack[$i] === $needle) {
            $count++;
        }
    }
    return $count;
}
var_dump(my_str_search('la plateforme', 'a'));


