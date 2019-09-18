<?php

class IndexController {
    public function index() {

        if(isset($_POST['countAllImages'])) {
            $user = new User();
            $img = $user->countAllImages();

            $view = new View();
            $view->render('index', [
                'allImages' => 'Number of images: '.$img['COUNT(imageName)']
            ]);
        }
        else {
            $view = new View();
            $view->render('index',[
            'allImages' => ' '
            ]);
        }
    }

    public function count() {
        $user = new User();
        $img = $user->countAllImages();

        echo $img['COUNT(imageName)'];

        /*$view = new View();
        $view->render('index', [
            'allImages' => $img['COUNT(imageName)']
        ]);*/
    }

}