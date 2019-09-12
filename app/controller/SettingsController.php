<?php

class SettingsController {
    public function index() {
        Session::start();

        $view = new View();
        $view->render('settings', [
            'homeMessage' => $_SESSION['username']
        ]);
    }

    public function changePassword() {
        if(isset($_POST['changePassword'])) {
            Session::start();
            $password = $_POST['password'];

            $user = new User();
            $user->updateUser($_SESSION['username'], $password);
        }
    }
}