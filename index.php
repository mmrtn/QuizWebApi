<?php
// front controller - index.php

spl_autoload_register( 'autoload' );

// function autoloader loads requires all php files from Classes folder

function autoload( $files ) {

    require_once '/Classes/'.$files.'.php';
}
require_once 'config.php';


$game=new Game();

?>