<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

function merge($left,$right){
    $array=[];
    $i=0;
    $j=0;
    $k=0;
    while(isset($left[$i]) && isset($right[$j])){
        if($left[$i]<$right[$j]){
            $array[$k]=$left[$i];
            $k++;$i++;
        }
        else{
            $array[$k]=$right[$j];
            $k++;$j++;
        }
    }
    while(isset($left[$i])){
        $array[$k]=$left[$i];
        $k++;$i++;
    }
    while(isset($right[$j])){
        $array[$k]=$right[$j];
        $k++;$j++;
    }
    return $array;
}

function mergeSort($array){
    $length=count($array); 
    if($length===1) return $array; 
    $i=0; 
    while($i < $length/2){ 
        $left[$i]=$array[$i]; 
        $i++; 
    } 
    $j=0; 
    while($j+$i < $length){ 
        $right[$j]=$array[$i+$j]; 
        $j++; 
    } 
    $left=mergeSort($left); 
    $right=mergeSort($right); 
    return merge($left,$right); 
}
$array=[5,3,7,4,8,2,1];
print_r(mergeSort($array));


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);

    if (isset($data['array']) && is_array($data['array'])) {
        $sortedArray = mergeSort($data['array']);
        echo json_encode(["sortedArray" => $sortedArray]);
    } else {
        echo json_encode(["error" => "Invalid input. Provide an array in the 'array' parameter."]);
    }
} else {
    echo json_encode(["error" => "Invalid request method. Use POST."]);
}
?>
