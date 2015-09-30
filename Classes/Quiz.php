<?php

class Quiz {

    private $quiz_test; //this Array contains Variants Objects

    function __construct($nr_of_questions=10, $year_from=1946, $year_to=2015) {
        $this->quiz_test = $this->create_test($nr_of_questions, $year_from, $year_to);
    }

    private function create_test($nr_of_questions, $year_from, $year_to) {
        $nr_of_questions*=6;
        $test = array();
        $test_variant = array();
        $db_conn = new Database();

        // example: SELECT * FROM hot100_billboard WHERE year>=1960 and year<=1965 ORDER BY RAND() LIMIT 50

        $sql = "SELECT * FROM hot100_billboard WHERE year>=$year_from and year<=$year_to ORDER BY RAND() LIMIT $nr_of_questions";

        $query = $db_conn->db_query($sql);

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
