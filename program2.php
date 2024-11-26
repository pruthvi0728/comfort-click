<?php

// Given Input: aabbbccaaaac
// Encoded Output: 2a3b2c4ac

$inputString = "aabbbccaaaac";
$encodedString = encodeString($inputString);

echo $encodedString. "\n";

function encodeString($inputString) : string
{
    if(empty($inputString)) {
        return "";
    }
    $encodedString = "";
    $count = 0;
    for($i = 0; $i < strlen($inputString); $i++) {
        $count++;
        if(!isset($inputString[$i+1]) || $inputString[$i] != $inputString[$i+1]) {
            if($count > 1) {
                $encodedString .= $count.$inputString[$i];
            } else {
                $encodedString .= $inputString[$i];
            }
            $count = 0;
        }
    }

    return $encodedString;
}
