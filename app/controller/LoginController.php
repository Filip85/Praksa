<?php

class LoginController {
    public function index() {

        $view = new View();
        $view->render('login', [
            'homeMessage' => 'Da vidim jel radi.'
        ]);
    }
    public function signin() {

        $username = $_POST['username'];
        $password = $_POST['password'];

        if(isset($_POST['signInButton'])) {

            if(empty($username) || empty($password)) {
                echo 'Please enter your username and password!';
            }
            else {
                $user = new User();
                $userExists = $user->getUser($username);
                var_dump($userExists);
                /*$pwdcheck = password_verify($password, $userExists['pwdUser']);
                echo $userExists['pwdUser'];*/
                if(($userExists === $username) /*&& $pwdcheck === true*/) {
                    Session::start();
                    Session::set('username', $username);
                    $session = Session::get('username');
                    echo $session;
                    header('Location: /profile');

                }
                else {
                    echo 'User does not exist';
                }
            }
        }
    }

    public function signout() {
        if(isset($_POST['signOutButton'])) {
            Session::start();
            Session::stop();
            header("Location:..");
        }
    }
}