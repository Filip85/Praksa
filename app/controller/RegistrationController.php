<?php

class RegistrationController {
    public function index() {

        $view = new View();
        $view->render('registration', [
            'homeMessage' => 'Da vidim jel radi.'
        ]);
    }
    public function signup() {

        $username = $_POST['username'];
        $email = $_POST['email'];
        $password_1 = $_POST['password'];
        $password_2 = $_POST['repeatPassword'];

        if(isset($_POST['signUpButton'])) {
            //$db = Db::getInstance();

            if(empty($username) || empty($email) || empty($password_1) || empty($password_1)) {
                echo 'Please enter your username, email and password!';
            }
            else {
                if(($password_1 !== $password_2) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    echo 'Passwords dont match or email is invalid';
                }
                else {

                    $db = Db::getInstance()->prepare("SELECT uidUser, pwdUser FROM users WHERE uidUser=?");
                    $db->execute([$username]);

                    if($db->rowCount() > 0) {
                        echo 'Please enter another username!';
                    }
                    else {
                        $hashedPwd = password_hash($password_1, PASSWORD_DEFAULT);
                        $user = new User();
                        $user->insert($username, $email, $hashedPwd);
                    }
                }
            }

            header("Location: ../app/view/main.phtml");
        }
    }
}