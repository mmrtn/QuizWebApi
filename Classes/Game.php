<?php


/**
 * Class Game
 */
class Game
{

    /**
     * @var string $ticket
     * each ticket is unique and connects 10-quesiton quiz with answers
     */
    private $ticket;


    public function __construct()
    {
        $this->create_quiz();
    }

    /**
     *  generates quiz by adding test questions/answers to database
     */
    private function create_quiz() {
        $this->ticket = $this->generateRandomString();
        $qustion_nr=0;
        $quiz=new Quiz();
        $test=$quiz->getQuiz_test();

        foreach ($test as $variant) {
            $questions=$variant->get_Variant(); //array from Variant object
            $answer=$variant->get_Answer();

            $db_conn = new Database();
            $db_link= $db_conn->get_conn();
            $query_str = "INSERT INTO `quiz`(`test_array`, `answer`, `ticket`) VALUES ('%s', '%s', '%s')";

            $sql = sprintf($query_str, mysqli_real_escape_string($db_link, json_encode($questions)), $answer, $this->ticket.'Q'.$qustion_nr);

            $db_conn->db_query($sql);

            $qustion_nr++;
        }
    }


    /**
     * @param int $length
     * @return string
     */
    private function generateRandomString($length = 16) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }


    /**
     * @return mixed
     */
    public function getTicket()
    {
        return $this->ticket;
    }


}