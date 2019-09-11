<?php

class BFC extends Db{
    public function login(){
        $username = $_POST['username'];
        $password = $_POST['password'];

        if(isset($_POST['signInButton'])) {

            if(empty($username) || empty($password)) {
                echo 'Please enter your username and password!';
            }
            else {
                $user = new User();
                $user->getUser($username, $password);
            }
        }
    }

    public function registration() {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password_1 = $_POST['password'];
        $password_2 = $_POST['repeatPassword'];

        if(isset($_POST['signUpButton'])) {
            $db = Db::getInstance();

            if(empty($username) || empty($email) || empty($password_1) || empty($password_1)) {
                echo 'Please enter your username, email and password!';
            }
            else {
                if(($password_1 !== $password_2) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    echo 'Passwords dont match or email is invalid';
                }
                else {
                    $stmt = $db = Db::getInstance()->prepare("SELECT uidUser, pwdUser FROM users WHERE uidUser='Filip1231'");
                    //$stmt->execute([$username]);

                    $hashedPwd = password_hash($password_1, PASSWORD_DEFAULT);
                    $user = new User();
                    $user->insert($username, $email, $hashedPwd);

                    /*if($stmt->rowCount()) {
                        while ($row = $stmt->fetch()) {
                            if($row['uidUser'] > 0) {
                                echo 'Please enter another Username';
                            }
                            else {
                                $hashedPwd = password_hash($password_1, PASSWORD_DEFAULT);
                                $user = new User();
                                $user->insert($username, $email, $hashedPwd);
                            }
                        }
                    }*/

                    /*if($row > 1) {
                        echo 'Please enter another Username';
                    }
                    else {
                        $hashedPwd = password_hash($password_1, PASSWORD_DEFAULT);
                        $user = new User();
                        $user->insert($username, $email, $hashedPwd);
                    }*/
                }
            }
        }
    }
}
