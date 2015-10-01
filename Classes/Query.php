<?php

class Query extends Database
{
    /*@var $result Array*/
    private $result;

    public function __construct($sql)
    {
        parent::__construct();
        $this->result=$this->sql_query($sql);

    }

    public function sql_query($sql) {
        $result=$this->db_query($sql)->fetch_assoc();
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