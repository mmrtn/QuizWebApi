<?php

//will be used by cronjob

require_once 'Classes/Database.php';
require_once 'config.php';

function get_timestamp()
{
    $date = new DateTime();
    $date_format = $date->format("Y-m-d H:i:s");
    return $date_format;
}


function log_query($line)
{

    file_put_contents('clean.log', PHP_EOL . $line, FILE_APPEND);
}

$db = new Database();

// Deletes all fields from quiz table that are older than 2h.
$db->db_query("DELETE FROM quiz WHERE timestamp < DATE_SUB(NOW(), INTERVAL 2 HOUR)");

$db->close_conn();

ini_set('date.timezone', 'Europe/Tallinn');
date_default_timezone_set('Europe/Tallinn');
log_query(get_timestamp());

