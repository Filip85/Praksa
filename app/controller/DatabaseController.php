<?php

class DatabaseController {
    public function index() {
        $bfc = new BFC();


        $view = new View();
        $view->render('registration', [
            'homeMessage' => 'Da vidim jel radi.'
        ]);
    }
    public function signup() {
        /*$db = new Db();
        $db->connect();*/

        $view = new View();
        $view->render('registration', [
            'homeMessage' => 'Da vidim jel radi.'
        ]);

        $bfc = new BFC();
        $bfc->registration();


    }
}