<?php
// front controller
spl_autoload_register( 'autoload' );

function autoload( $files ) {

    require_once '/Classes/'.$files.'.php';
}


?>