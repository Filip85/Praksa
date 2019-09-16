<?php

class SettingsController {
    public function index() {
        Session::start();
        $session = Session::get('username');

        $user = new User();
        $userStatus = $user->getStatus($session);

        $view = new View();
        $view->render('settings', [
            'homeMessage' => $_SESSION['username'],
            'status' => $userStatus
        ]);
    }

    public function changePassword() {
        if(isset($_POST['changePassword'])) {
            Session::start();
            $password = $_POST['password'];
            $hashedPwd = password_hash($_POST['password'], PASSWORD_DEFAULT);

            $user = new User();
            $user->updateUser($_SESSION['username'], $hashedPwd);

            header('Location: /settings');
        }
    }

    public function changeStatus() {
        if(isset($_POST['changeStatus'])) {
            Session::start();
            $session = Session::get('username');

            $user = new User();
            $status = $user->getStatus($session);

            if($status === 'public') {
                $user->changeStatus('private', $session);
            }
            else {
                $user->changeStatus('public', $session);
            }

            header('Location: /settings');
        }
    }
}