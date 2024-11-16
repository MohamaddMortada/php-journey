<?php

function isPalindrome($String){
    $i=0;
    $len=strlen($String);
    while($i < ($len-1)/2){
        if($String[$i] !== $String[$len - $i])
            return false
        $i++;
    }
    return true
}

?>