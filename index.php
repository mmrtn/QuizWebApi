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

if (array_key_exists('method', $_GET)) {

    if(strcasecmp($_GET['method'], 'quiz') == 0) {
        $api_response['status']=200;
        $game = new Game();
        $api_response['ticket']=$game->getTicket();
        WebAPI::deliver_response('json', $api_response);
    }
    elseif (strcasecmp($_GET['method'], 'answer') == 0 && array_key_exists('ticket', $_GET)) {
        $api_response['ticket']='FALSE';
        $ticket=$_GET['ticket'];

        if (Validate::is_ticket($ticket)) {
            $api_response['status']=200;
            $api_response['ticket']='TRUE';
        }

        WebAPI::deliver_response('json', $api_response);

    }

}


else {
    echo 'Check API manual!';
}

?>