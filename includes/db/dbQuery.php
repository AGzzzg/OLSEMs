<?php

include('dbConnect.php');
$config = include('config.php');

class dbQuery extends dbConnect
{
    public $msg;

    // function used to insert new value in paste bin.

    public function saveData($data = array(), $table)
    {
        $cols = implode(",", array_keys($data));
        $values = implode(",", array_map(array($this, "addQuote"), array_values($data)));
        $sql = "insert into $table ($cols) values($values)";
         //echo $sql;
          //die();
        if ($this->connection->query($sql) === TRUE) {
            return mysqli_insert_id($this->connection);
        } else {
            return false;
        }

        // $this->connection->close();
        // $this->connection->close();
        
    }
    public function updateData($table, $data = array(), $where = "")
    {

        $sql = "update $table set";
        $i = 1;
        foreach ($data as $k => $v) {
            $sql .= " " . $k . " = " . $this->addQuote($v);

            if (sizeof($data) != $i) {
                $sql .= " , ";
            }
            $i = $i + 1;
        }
        $sql .= !empty($where) ? " Where " . $where : "";


        //echo $sql;die();
        if ($this->connection->query($sql) === TRUE) {
            return true;
        } else {
            $this->msg = "Error: " . $sql . "<br>" . $this->connection->error;
        }

        //$this->connection->close();
        // $this->connection->close();
    }

    public function getData($table, $cols = array(), $where = "", $orderBy = "")
    {
        if (empty($cols)) {
            $sql = "select * from $table";
        } else {
            $sql = "select " . implode(",", $cols) . " from $table";
        }
        $sql .= !empty($where) ? " Where " . $where : "";
        $sql .= !empty($orderBy) ? " order by " . $orderBy : "";
       
   //echo $sql;//die();
        $result = $this->connection->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            return $result;
        } else {
            $this->msg = "No Results Found..";
            return 0;
        }
    }
    // add quote to string values for a query
    function deleteData($table="",$where = "")
	{
		   $sql = "delete from $table";
		    $sql .= !empty($where) ? " Where " . $where : "";
			
			if ($this->connection->query($sql) === TRUE) {
				
            return true;
        } else {
            $this->msg = "Error: " . $sql . "<br>" . $this->connection->error;
        }
	}
    function addQuote($val)
    {
        return is_int($val) ? $val : sprintf("'%s'", $val);
    }
    function existsAlready($col = "", $table, $where = "")
    {
        $sql = "";
        if (!empty($col) && !empty($table) && !empty($where)) {

            $sql = "SELECT $col FROM $table WHERE  " . $where;
            //die($sql);
            $result = $this->connection->query($sql);
            if ($result->num_rows > 0) {
                return true;
            } else {
                return false;
            }
        }
    }
	
}
