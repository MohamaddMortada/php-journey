<?php

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

class Node{
    public $data;     
    public $next;      

    public function __construct($data) {
        $this->data = $data;
        $this->next = null;
    }
}

class LinkedList{
    public $head;    

    public function __construct() {
        $this->head = null;
    }

    public function push($data){
        $newNode = new Node($data);

        if ($this->head === null){
            $this->head = $newNode;
            return;
        }

        $current = $this->head;
        while ($current->next !== null){
            $current = $current->next;
        }

        $current->next = $newNode;
    }
}

function checkTwoVowels($node){
    if ($node === null) {
        return;
    }

    $vowels = ['a','e','i','o','u'];
    $counter = 0;

    foreach ($vowels as $vowel){
        $counter += substr_count(strtolower($node->data), $vowel);
    }

    if ($counter >= 2){
        echo $node->data . "\n";
    }

    checkTwoVowels($node->next);
}

$linkedList = new LinkedList();

$linkedList->push("mhmd");
$linkedList->push("nabiha");
$linkedList->push("taha");
$linkedList->push("charbel");

checkTwoVowels($linkedList->head);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);

    if (isset($data['strings']) && is_array($data['strings'])) {
        $linkedList = new LinkedList();

        foreach ($data['strings'] as $string) {
            $linkedList->push($string);
        }

        $result = [];
        checkTwoVowels($linkedList->head, $result);

        echo json_encode(["result" => $result]);
    } else {
        echo json_encode(["error" => "Invalid input. Provide an array of strings in 'strings'."]);
    }
} else {
    echo json_encode(["error" => "Invalid request method. Use POST."]);
}

?>
