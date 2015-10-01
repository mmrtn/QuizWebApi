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

if (count($_GET)) {

    if(array_key_exists('method', $_GET) && strcasecmp($_GET['method'], 'newquiz') == 0) {
        $api_response['status']=200;
        $game = new Game();
        $api_response['ticket']=$game->getTicket();
        WebAPI::deliver_response('json', $api_response);
    }
    elseif (array_key_exists('ticket', $_GET) && Check::is_ticket($_GET['ticket'])) {
        $ticket=$_GET['ticket'];
        if (array_key_exists('method', $_GET) && $_GET['method']=='next') {
            $api_response['status']=200;
            $api_response['youTubeId']='not where yet...';
            $api_response['variants']=json_decode(Check::get_varinats($ticket));
            WebAPI::deliver_response('json', $api_response);
        }
        elseif (array_key_exists('answer', $_GET)) {
            $answer=$_GET['answer'];

            $api_response['ticket']='TRUE';
            $api_response['status']=200;
            $api_response['answer']='INCORRECT!';

            if (Check::is_correct_answer($answer, $ticket)) {
                $api_response['answer']='CORRECT!';
            }
            WebAPI::deliver_response('json', $api_response);
        }
    }


    else {
        echo 'Incorrect API parameters!';
    }


}



?>