<?php
/**
 * Created by PhpStorm.
 * User: rob
 * Date: 27/09/2016
 * Time: 19:36
 */

function call($controller, $action) {
    require_once ('controllers/' . $controller . '_controller.php');

    //check if piece has already been installed


    switch($controller) {
        case 'pages':
            $controller = new PagesController();
            get_class($controller);
            break;
        case 'posts':
            require_once('models/post.php');
            $controller = new PostsController();
    }

    $controller->{ $action }();
}

$controllers = array('pages' => ['home', 'error'],
                     'posts' => ['index', 'show']);



if (array_key_exists($controller, $controllers)) {
    if (in_array($action, $controllers[$controller])) {
        call($controller, $action);
    } else {
        call('pages', 'error');
    }
} else {
    call('pages', 'error');
}