<?php
class PWMan {
    public function __construct()
    {
        include_once('view.php');
    }

    public function run()
    {
        $t = new MyView();
        $t->friends = array(
            'Rachel', 'Monica', 'Phoebe', 'Chandler', 'Joey', 'Ross'
        );
        $t->render('index.phtml');
    }
}

$pwman = new PWMan;
$pwman->run();