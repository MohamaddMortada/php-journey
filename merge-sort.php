<?php

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
            $array[$k]=$right[j];
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

?>
