<?php


class Check
{
    static function is_ticket($ticket) {
        if (ctype_alnum($ticket) && strlen($ticket)===16) {

            $query=new Query("SELECT COUNT(`ticket`) FROM `quiz` WHERE BINARY `ticket` LIKE '$ticket%';");

            if ((int) $query->getResult()["COUNT(`ticket`)"]) {
                return true;
            }
        }
        return false;
    }

    static function is_correct_answer($answer, $ticket) {

        $query=new Query("SELECT `answer`,`id` FROM `quiz` WHERE BINARY `ticket` LIKE '$ticket%' LIMIT 1");
        $id = (int) $query->getResult()['id'];

        if ((int) $query->getResult()['answer'] === (int) $answer) {

            $query=new Query("DELETE FROM `quiz` WHERE id=$id", false);
            return true;
        }
        return false;

    }

    static function get_varinats($ticket) {
        $query=new Query("SELECT `test_array` FROM `quiz` WHERE BINARY `ticket` LIKE '$ticket%' LIMIT 1");
        return $query->getResult()['test_array'];
    }
}