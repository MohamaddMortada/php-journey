<?php

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

function length($Array){
    $i=0;
    while(isset($Array[$i])){
        $i++;
    }
    return $i;
}

function isPalindrome($String){
    $i=0;
    $len=length($String);
    while($i < ($len-1)/2){
        if($String[$i] !== $String[$len - $i])
            return false
        $i++;
    }
    return true
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);

    if (isset($data['string']) && is_string($data['string'])) {
        $result = isPalindrome($data['string']);
        echo json_encode(["isPalindrome" => $result]);
    } else {
        echo json_encode(["error" => "Invalid input. Provide a valid 'string' parameter."]);
    }
} else {
    echo json_encode(["error" => "Invalid request method. Use POST."]);
}


?>