<?php

class Database {

    private $connection;

    //put your code here
    public function __construct($servername = DATABASE_HOSTNAME, $username = DATABASE_USERNAME, $password = DATABASE_PASSWORD, $dbname = DATABASE_NAME) {

        $conn = $this->connect_db($servername, $username, $password, $dbname);
        $this->connection = $conn;
        // $this->connection=connect_db($servername, $username, $password, $dbname);
    }

    private function connect_db($servername, $username, $password, $dbname) {
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        return $conn;
    }

    public function get_conn() {
        return $this->connection;
    }

    public function db_query($sql_query) {
        $result = mysqli_query($this->get_conn(), $sql_query);

        if (!$result) {

            echo "<h3>SQL query: " . $sql_query . "</h3>";
            echo "<p>Error description: " . mysqli_error($this->get_conn()) . "</p>";
        } else {

            return $result;
        }
    }

    public function close_conn() {
        $thread = $this->connection->thread_id;
        // echo "<h2>$thread</h2>";
        $this->get_conn()->kill($thread);
        mysqli_close($this->get_conn());
    }

}

?>