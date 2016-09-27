<?php
/**
 * Created by PhpStorm.
 * User: rob
 * Date: 27/09/2016
 * Time: 19:32
 */
?>
<DOCTYPE html>
    <html>
    <head>
    </head>
    <body>
        <header>
            <a href="/pwman">Home</a>
            <a href='?controller=posts&action=index'>Posts</a>
        </header>

        <?php require_once('routes.php'); ?>

        <footer>
            ©<?php echo date('Y'); ?> rk21980
        </footer>
    </body>
    </html>
</DOCTYPE>
