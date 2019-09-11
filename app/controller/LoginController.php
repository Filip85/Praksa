<?php

class LoginController {
    public function index() {

        $view = new View();
        $view->render('login', [
            'homeMessage' => 'Da vidim jel radi.'
        ]);
    }
    public function signin() {
        $view = new View();
        $view->render('login', [
            'homeMessage' => 'Da vidim jel radi.'
        ]);

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
            header("Location: ../app/view/main.phtml");
        }
    }
}