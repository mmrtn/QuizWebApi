<?php

class Query extends Database
{
    private $result;

    public function __construct($sql, $result_as_array=true)
    {
        parent::__construct();
        $this->result=$this->sql_query($sql, $result_as_array);

    }

    private function sql_query($sql, $result_as_array) {
        if ($result_as_array) {
            $result=$this->db_query($sql)->fetch_assoc();
        }
        else {
            $result=$this->db_query($sql);
        }

        $this->close_conn();
        return $result;
    }

    /**
     * @return array
     */
    public function getResult()
    {
        return $this->result;
    }


}