<?php

class ProfileController {
    public function index() {
        Session::start();

        $view = new View();
        $view->render('profile', [
            'homeMessage' => $_SESSION['username']
        ]);
    }
}