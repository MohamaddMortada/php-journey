<?php
class user{
    public $username;
    public $email;
    public $password;

    public function __construct($username, $email, $password){
        $this->username = $username;
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
}
?>