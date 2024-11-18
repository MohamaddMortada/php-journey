<?php

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

class user{
    public $email;
    public $password;

    public function __construct($email, $password){
        $this->email = $email;
        $this->password = $password;
    }
    public static function check_password($password){
        $capital=range('A','Z');
        $lower=range('a','z');
        $specialCharacters = ['!', '@', '#', '$', '%', '^', '&', '*', '(', ')', '-', '_', '=', '+', '[', ']', '{', '}', ';', ':', '"', "'", '<', '>', ',', '.', '?', '/', '\\', '|', '~', '`'];

        $hasUpper = false;
        foreach ($capital as $c) {
            if (strpos($password, $c) !== false){
                $hasUpper = true;
                break;
            }
        }
        $hasLower = false;
        foreach ($lower as $c) {
            if (strpos($password, $c) !== false){
                $hasLower = true;
                break;
            }
        }
        $hasSpecial = false;
        foreach ($specialCharacters as $c) {
            if (strpos($password, $c) !== false){
                $hasSpecial = true;
                break;
            }
        }
        if (strlen($password) < 12){
            return false;
        }
        return $hasUpper && $hasLower && $hasSpecial;
    }

    public static function validate_email($email){
    
        $counterAt=0;
        $counterCom=0;
        
        $counterAt = substr_count($email, '@');
        $counterCom = substr_count($email, '.');

        if($counterAt!==1 || $counterCom<1)
        return false;
    return true;

    }
    public function copy_with($email = null, $password = null) {
        return new User(
            $email ?? $this->email,
            $password ?? $this->password
        );
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);

    if (!isset($data['action'])) {
        echo json_encode(["error" => "Action parameter is required."]);
        exit();
    }

    switch ($data['action']) {
        case 'validate_email':
            if (isset($data['email'])) {
                $isValid = User::validate_email($data['email']);
                echo json_encode(["email" => $data['email'], "isValid" => $isValid]);
            } else {
                echo json_encode(["error" => "Email is required for validation."]);
            }
            break;

        case 'check_password':
            if (isset($data['password'])) {
                $isStrong = User::check_password($data['password']);
                echo json_encode(["password" => $data['password'], "isStrong" => $isStrong]);
            } else {
                echo json_encode(["error" => "Password is required for validation."]);
            }
            break;

        case 'create_user':
            if (isset($data['email'], $data['password'])) {
                $isEmailValid = User::validate_email($data['email']);
                $isPasswordStrong = User::check_password($data['password']);

                if ($isEmailValid && $isPasswordStrong) {
                    $user = new User($data['email'], $data['password']);
                    echo json_encode(["message" => "User created successfully.", "user" => ["email" => $user->email]]);
                } else {
                    echo json_encode([
                        "error" => "Invalid input.",
                        "emailValid" => $isEmailValid,
                        "passwordStrong" => $isPasswordStrong
                    ]);
                }
            } else {
                echo json_encode(["error" => "Email and password are required to create a user."]);
            }
            break;

        default:
            echo json_encode(["error" => "Invalid action."]);
            break;
    }
} else {
    echo json_encode(["error" => "Invalid request method. Use POST."]);
}
?>