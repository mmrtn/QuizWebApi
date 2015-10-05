<?php

/**
 * Class Database
 *
 */
class Database {

    /**
     * @var object $connection
     * represents the connection to a MySQL Server
     */

    private $connection;

    /**
     * @param string $servername
     * @param string $username
     * @param string $password
     * @param string $dbname
     * default values are using constants from config.php
     */

    public function __construct($servername = DATABASE_HOSTNAME, $username = DATABASE_USERNAME, $password = DATABASE_PASSWORD, $dbname = DATABASE_NAME) {

        $conn = $this->connect_db($servername, $username, $password, $dbname);
        $this->connection = $conn;
        // $this->connection=connect_db($servername, $username, $password, $dbname);
    }


    /**
     * @param $servername
     * @param $username
     * @param $password
     * @param $dbname
     * @return mysqli
     */
    private function connect_db($servername, $username, $password, $dbname) {
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        return $conn;
    }

    /**
     * @return object
     */
    public function get_conn() {
        return $this->connection;
    }

    /**
     * @param $sql_query
     * @return bool|mysqli_result
     */
    public function db_query($sql_query) {
        $result = mysqli_query($this->connection, $sql_query);

        if (!$result) {

            echo "<h3>SQL query: " . $sql_query . "</h3>";
            echo "<p>Error description: " . mysqli_error($this->get_conn()) . "</p>";
        } else {

            return $result;
        }
    }

    /**
     * close connection and kill the thread
     */
    public function close_conn() {
        $thread = $this->connection->thread_id;
        // echo "<h2>$thread</h2>";
        $this->get_conn()->kill($thread);
        mysqli_close($this->get_conn());
    }

}

?>