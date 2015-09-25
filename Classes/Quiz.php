<?php

class Quiz {

    private $quiz_test; //this Array contains Variants Objects

    function __construct($nr_of_questions=10) {
        $this->quiz_test = $this->create_test($nr_of_questions);
    }

    private function create_test($nr_of_questions) {
        $test = array();
        $test_variant = array();
        $db_conn = new Database();
        $nr_of_questions*=6;
        $sql = "SELECT * FROM hot100_billboard ORDER BY RAND() LIMIT $nr_of_questions";
        echo "<h3>$sql</h3>";
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
