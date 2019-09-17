<?php

class IndexController {
    public function index() {
        $user = new User();
        $img = $user->getPicturesInformation();

        $view = new View();
        $view->render('index', [
            'allImages' => $img
        ]);
    }
}