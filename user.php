<?php
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
?>