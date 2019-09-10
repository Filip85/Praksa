<?php

class IndexController {
    public function index()
    {
        $view = new View();
        $view->render('index', [
            'homeMessage' => 'Da vidim jel radi.'
        ]);

        $db = new Db();
        $db->connect();
    }
}