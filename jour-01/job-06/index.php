<?php

function my_array_sort(array $arrayToSort, string $order): array {
    if ($order === "ASC") {
        for ($i = 0; $i < count($arrayToSort) - 1; $i++) {
            for ($j = 0; $j < count($arrayToSort) - $i - 1; $j++) {
                if ($arrayToSort[$j] > $arrayToSort[$j + 1]) {
                    $temp = $arrayToSort[$j];
                    $arrayToSort[$j] = $arrayToSort[$j + 1];
                    $arrayToSort[$j + 1] = $temp;
                }
            }
        }
    } elseif ($order === "DESC") {
        for ($i = 0; $i < count($arrayToSort) - 1; $i++) {
            for ($j = 0; $j < count($arrayToSort) - $i - 1; $j++) {
                if ($arrayToSort[$j] < $arrayToSort[$j + 1]) {
                    $temp = $arrayToSort[$j];
                    $arrayToSort[$j] = $arrayToSort[$j + 1];
                    $arrayToSort[$j + 1] = $temp;
                }
            }
        }
    }

    return $arrayToSort;
}

var_dump(my_array_sort([2, 24, 12, 7, 34], 'ASC'));
var_dump(my_array_sort([8, 5, 23, 89, 6, 10], 'DESC'));
var_dump(my_array_sort(["banane", "abricot", "chateau"], 'ASC'));
var_dump(my_array_sort(["banane", "abricot", "chateau"], 'DESC'));