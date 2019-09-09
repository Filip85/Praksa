<?php

class View {
    protected $layout = 'header';
    public function render($name, $args = []) {
        ob_start();
        extract($args);
        include "app/view/$name.phtml";

        //var_dump($name);

        $content = ob_get_clean();
        echo $content;

        include "app/view/header.phtml";

        //echo $content;

    }

}