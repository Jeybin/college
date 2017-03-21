<?php

class DbConnection {

    private $_host = "localhost";
    private $_username = "root";
    private $_password = "";
    private $_database = "pro_college";
    public $connection;

    function __construct() {
        $this->connection = new mysqli($this->_host, $this->_username, $this->_password, $this->_database);
        if (mysqli_connect_error()) {
            trigger_error("Failed to conenct to MySQL: " . mysql_connect_error(), E_USER_ERROR);
        }
    }


    public function setData($query) {
        $result = mysqli_query($this->connection, $query) or die(mysqli_error());
        if ($result)
            return true;
        else
            return false;
    }
    public function setDataAndReturnLastInsertId($query) {
        $result = mysqli_query($this->connection, $query) or die(mysqli_error());
        $lastinsertid = mysqli_insert_id($this->connection);
        if ($result){
            return array('1',$lastinsertid);
          }
        else{
            return false;
        }
    }

    public function getData($query) {
        $result = $this->connection->query($query) or die(mysqli_error($this->connection));
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }


}
