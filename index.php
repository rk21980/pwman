<?php
class PWMan {
    public function __construct()
    {
        include_once('view.php');
        require_once 'authenticator.php';
    }

    public function run()
    {
        $t = new PWMan_View();
        $t->friends = array(
            'Rachel', 'Phoebe', 'Chandler', 'Joey', 'Ross'
        );
        $t->render('index.phtml');
    }
}

$pwman = new PWMan();
$pwman->run();