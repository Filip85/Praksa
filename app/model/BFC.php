<?php

class BFC {
    public function login(){
        $username = $_POST['username'];
        $password = $_POST['password'];

        if(isset($_POST['signInButton'])) {
            $db = new Db();
            $db->connect();

            if(empty($username) || empty($password)) {
                echo 'Please enter your username and password!';
            }
            else {

            }
        }
    }

    public function registration() {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password_1 = $_POST['password'];
        $password_2 = $_POST['repeatPassword'];

        if(isset($_POST['signUpButton'])) {
            $db = new Db();
            $db->connect();

            if(empty($username) || empty($email) || empty($password_1) || empty($password_1)) {
                echo 'Please enter your username, email and password!';
            }
            else {
                if(($password_1 !== $password_2) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    echo 'Passwords dont match or email is invalid';
                }
                else {
                    $hashedPwd = password_hash($password_1, PASSWORD_DEFAULT);
                    $user = new User();
                    $user->insert($username, $email, $hashedPwd);
                }
            }
        }
    }
}
