<?php
/**
 * Created by PhpStorm.
 * User: rob
 * Date: 27/09/2016
 * Time: 19:43
 */
<?php
class PagesController {
    public function home() {
        $first_name = 'Jon';
        $last_name  = 'Snow';
        require_once('views/pages/home.php');
    }

    public function error() {
        require_once('views/pages/error.php');
    }
}
?>