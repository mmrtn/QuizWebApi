<?php


class WebAPI
{
    static function deliver_response($format, $api_response)
    {

        // Define HTTP responses
        $http_response_code = array(
            200 => 'OK',
            400 => 'Bad Request',
            401 => 'Unauthorized',
            403 => 'Forbidden',
            404 => 'Not Found'
        );

        // Set HTTP Response
        header("Access-Control-Allow-Origin: *");

        header('HTTP/1.1 ' . $api_response['status'] . ' ' . $http_response_code[$api_response['status']]);

        // Process different content types
        if (strcasecmp($format, 'json') == 0) {

            // Set HTTP Response Content Type
            header('Content-Type: application/json; charset=utf-8');

            // Format data into a JSON response
            // trim($api_response['song']);
            $json_response = json_encode($api_response);

            // Deliver formatted data
            echo $json_response;
        }

        exit();
    }
}

