<?php
function length($Array){
    $i=0;
    while($Array[$i]){
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

?>