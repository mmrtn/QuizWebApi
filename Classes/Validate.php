<?php


class Validate
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
}