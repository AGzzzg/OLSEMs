<?php

/**
 * Created by PhpStorm.
 * User: adnan
 * Date: 3/31/2020
 * Time: 4:57 AM
 */

class dbConnect
{
    private $serverName;
    private $userName;
    private $password;
    private $db;
    public $connection;
    function __construct($serverName, $userName, $password, $db)
    {
        $this->serverName = $serverName;
        $this->userName = $userName;
        $this->password = $password;
        $this->db = $db;
        $this->connection = new mysqli($this->serverName, $this->userName, $this->password, $this->db);
        // Check connection
        if ($this->checkConnection())
            //die("connected");
            return $this->connection;
    }
    function checkConnection()
    {

        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
        return true;
    }
    function saveSQLInjection($val)
    {
        $val = mysqli_real_escape_string($this->connection, $val);
        return $val;
    }
}
