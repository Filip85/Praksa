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
            'status' => $userStatus['userStatus']
        ]);


    }

    public function changePassword() {
        if(isset($_POST['changePassword'])) {
            Session::start();
            $password = $_POST['password'];
            $hashedPwd = password_hash($_POST['password'], PASSWORD_DEFAULT);

            User::updateUser($_SESSION['username'], $hashedPwd);

            header('Location: /settings');
        }
    }

    public function changeStatus() {
        if(isset($_POST['changeStatus'])) {
            Session::start();
            $session = Session::get('username');

            $status = User::getStatus($session);

            //echo $status;

            if($status['userStatus'] === 'public') {
                User::changeStatus('private', $session);
                echo $status;
            }
            else {
                User::changeStatus('public', $session);
            }

            header('Location: /settings');
        }
    }

    public function deleteUserAccount() {
        if(isset($_POST['removeAccount'])) {
            Session::start();
            $session = Session::get('username');

            User::deleteUser($session);
            Images::deleteUserImages($session);

            header('Location: ../');
        }

    }
}