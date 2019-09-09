<?php

class IndexController {
    public function index()
    {
        //echo 'I am in' . __CLASS__ . 'method' . __METHOD__;

        $view = new View();

        $view->render('index', [
            'content' => 'Da vidim jel radi.'
        ]);
    }
    /*public function about()   //testna funkcija da vidim jel' mi radi dobro
    {
        echo 'I am in' . __CLASS__ . 'method' . __METHOD__;
    }*/
}