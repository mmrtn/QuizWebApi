<?php

class Quiz {

    private $quiz_test; //this Array contains Variants Objects

    function __construct() {
        $this->quiz_test = $this->create_test();
    }

    private function create_test() {
        $test = array();
        $test_variant = array();
        $db_conn = new Database();
        $query = $db_conn->db_query("SELECT * FROM hot100_billboard ORDER BY RAND() LIMIT 60");

        foreach ($query as $i) {

            $test[] = $i;
            if (count($test) === 6) {
                $test_variant[] = new Variants($test);
                $test = array();
            }
        }

        $db_conn->close_conn();
        return $test_variant;
    }


    function getQuiz_test() {
        return $this->quiz_test;
    }


}
