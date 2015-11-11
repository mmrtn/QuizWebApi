<?php


/**
 * Class Game
 */
class Game
{
    /**
     * @var string $ticket
     * each ticket is unique and connects 10-quesiton quiz with answers
     *
     */
    private $ticket;


    public function __construct($year_from = 1946, $year_to = 2015)
    {
        $this->create_quiz($year_from, $year_to);
    }

    /**
     *  generates quiz and adds test questions/answers to database
     */
    private function create_quiz($year_from, $year_to)
    {
        $this->ticket = $this->generateRandomString();
        $qustion_nr = 0;
        if ($year_to - $year_from > 4) {
            $quiz = new Quiz($year_from, $year_to);

        } else {
            $quiz = new Quiz();

        }

        /**
         * @var Variants[] $test
         */
        $test = $quiz->getQuiz_test();
        /** @var $db Database */
        $db = new Database();
        /** @var $db_link mysqli */
        $db_link = $db->get_conn();


        foreach ($test as $variant) {

            $questions = $variant->get_Variant(); //array from Variant object
            $answer = $variant->get_Answer();
            $videoID = $variant->getVideoID();


            $query_str = "INSERT INTO `quiz`(`test_array`, `answer`, `ticket`, `videoID`) VALUES ('%s', '%s', '%s', '%s')";

            $sql = sprintf($query_str, mysqli_real_escape_string($db_link, json_encode($questions)), $answer, $this->ticket . 'Q' . $qustion_nr, $videoID);

            $db->db_query($sql);

            $qustion_nr++;
        }
        $db->close_conn();
    }


    /**
     * @param int $length
     * @return string
     */
    private function generateRandomString($length = 16)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }


    /**
     * @return int
     */
    public function getTicket()
    {
        return $this->ticket;
    }


}