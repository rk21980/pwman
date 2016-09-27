<?php
/**
 * Created by PhpStorm.
 * User: rob
 * Date: 27/09/2016
 * Time: 19:36
 */
echo __FILE__;

function call($controller, $action) {
    require_once ('controllers/' . $controller . '_controller.php');

    switch($controller) {
        case 'pages':
            $controller = new PagesController();
            get_class($controller);
            break;
    }

    $controller->{ $action }();
}

$controllers = array('pages' => ['home', 'error']);

echo "::".$controller."<br/>";


if (array_key_exists($controller, $controllers)) {
    if (in_array($action, $controllers[$controller])) {
        echo "calling $action";
        call($controller, $action);
    } else {
        call('pages', 'error');
    }
} else {
    call('pages', 'error');
}