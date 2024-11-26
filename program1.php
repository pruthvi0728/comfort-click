<?php

$inputArray = [
    "English" => "Subject",
    "India" => "Country",
    "Maths" => "Subject",
    "USA" => "Country",
    "Canada" => "Country",
    "Pen" => "Stationary",
];

$outputArray = convertArray($inputArray);
var_dump($outputArray);

function convertArray($array) : array
{
    if(!is_array($array)) {
        return [];
    }

    $outputArray = [];

    foreach($array as $key => $value) {
        // if($key === "Pen") {
        //     $key = "Subject";
        // }
        $outputArray[$value][] = $key;
    }

    return $outputArray;
}