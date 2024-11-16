<?php
function checkTwoVowels($linkedList){
    if($linkedList===null){
        return;
    }

    $vowels=['a','u','o','e','i'];
    $counter=0;
    $data=$linkedList['data'];
    foreach($vowels as $char){
        $counter += substr_count($data, $char);
    }
    if($counter>=2)
        echo $data, "\n";
    
    checkTwoVowels($linkedList['next']);
}
$linkedList=[
    'data'=>'mhmd',
    'next'=>[
    'data'=>'nabiha',
    'next'=>[
    'data'=>'taha',
    'next'=>[
    'data'=>'charbel',
    'next'=>null
    ]]]];
checkTwoVowels($linkedList);

?>