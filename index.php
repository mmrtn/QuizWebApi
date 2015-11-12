<?php
// front controller - index.php

spl_autoload_register('autoload');

// function autoloader loads requires all php files from Classes folder


function autoload($files)
{

    require_once 'Classes/' . $files . '.php';
}

require_once 'config.php';

$api_response = array(
    'status' => 400
);

// Check if there is any get request
if (isset($_GET)) {
    // Checks if any valid params are sent
    // generates response according to paramas

    $yearto = 2015;
    $yearfrom = 1946;

    if (array_key_exists('method', $_GET) && strcasecmp($_GET['method'], 'newquiz') == 0) {

        if (array_key_exists('yearto', $_GET)) {
            $yearto = $_GET['yearto'];
            if (is_numeric($yearto) && (int)$yearto > 1955 && (int)$yearto < 2016) {
                $yearto = (int)$yearto;
            }
        }
        if (array_key_exists('yearfrom', $_GET)) {
            $yearfrom = $_GET['yearfrom'];
            if (is_numeric($yearfrom) && (int)$yearfrom >= 1946 && (int)$yearfrom < 2011) {
                $yearfrom = (int)$yearfrom;

            }
        }

        $api_response['status'] = 200;
//            $game = new Game($yearfrom, $yearto);
        $game = new Game($yearfrom, $yearto);
        $api_response['ticket'] = $game->getTicket();
        WebAPI::deliver_response('json', $api_response);

    } elseif (array_key_exists('ticket', $_GET) && Check::is_ticket($_GET['ticket'])) {
        $ticket = $_GET['ticket'];
        if (array_key_exists('method', $_GET) && $_GET['method'] == 'next') {
            $api_response['status'] = 200;
            $api_response['videoID'] = Check::get_videoID($ticket);
            $api_response['variants'] = json_decode(Check::get_varinats($ticket)); //converts array to string in json
            WebAPI::deliver_response('json', $api_response);
        } elseif (array_key_exists('answer', $_GET)) {
            $answer = $_GET['answer'];

            $api_response['ticket'] = 'TRUE';
            $api_response['status'] = 200;
            $api_response['answer'] = 'INCORRECT!';

            if (Check::is_correct_answer($answer, $ticket)) {
                $api_response['answer'] = 'CORRECT!';
            }
            WebAPI::deliver_response('json', $api_response);
        }
    } else {
        $api_response['status'] = 400;
        $api_response['Error'] = 'Incorrect API parameters!';
        WebAPI::deliver_response('json', $api_response);
    }


}


?>