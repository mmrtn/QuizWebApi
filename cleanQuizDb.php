<?php

//will be used by cronjob

require_once '/Classes/Database.php';
require_once 'config.php';

function log_query($line) {

    file_put_contents('clean.log', PHP_EOL . $line, FILE_APPEND);
}

$db = new Database();

// Deletes all fields from quiz table that are older than 2h.
log_query($db->db_query("DELETE FROM quiz WHERE timestamp < DATE_SUB(NOW(), INTERVAL 2 HOUR)"));

$db->close_conn();
//SPIEeTas847