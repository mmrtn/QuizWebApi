<?php
// front controller - index.php

spl_autoload_register( 'autoload' );

// function autoloader loads requires all php files from Classes folder

function autoload( $files ) {

    require_once '/Classes/'.$files.'.php';
}
require_once 'config.php';

$api_response = array(
    'status'=>400
);


if (array_key_exists('method', $_GET) && strcasecmp($_GET['method'], 'quiz') == 0) {

    $api_response['status']=200;
    $game = new Game();
    $api_response['ticket']=$game->getTicket();
    WebAPI::deliver_response('json', $api_response);
}

else {
    echo 'Check API manual!';
}

?>