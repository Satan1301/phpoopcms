<?php
class Database {
    var $database_name;
    var $database_user;
    var $database_pass;
    var $database_host;
    var $database_link;
    function Database()
    {
        $this->database_user = DBUSER;
        $this->database_pass = DBPASS;
        $this->database_host = DBHOST;
        $this->database_name = DBNAME;
    }
    function changeUser($user)
    {
        $this->database_user = $user;
    }
    function changePass($pass)
    {
        $this->database_pass = $pass;
    }
    function changeHost($host)
    {
        $this->database_host = $host;
    }
    function changeName($name)
    {
        $this->databse_name = $name;
    }
    function changeAll($user, $pass, $host, $name)
    {
        $this->database_user = $user;
        $this->database_pass = $pass;
        $this->database_host = $host;
        $this->database_name = $name;
    }
    function connect()
    {
        $this->database_link = mysql_connect($this->database_host, $this->database_user, $this->database_pass)
        or
        die("Could not make connection to MySQL");
        mysql_select_db($this->database_name)
        or
        die ("Could not open database: " . $this->database_name);
    }
    function disconnect()
    {
        if (isset($this->database_link))
            mysql_close($this->database_link);
        else
            mysql_close();
    }
    function iquery($qry)
    {
        if (!isset($this->database_link))
            $this->connect();
        if (mysql_query($qry, $this->database_link))
            return true;
        else
            return false;
    }
    function query($qry)
    {
        global $query_sel, $sel_true, $sel_false;
        $query_sel++;
        if (!isset($this->database_link))
            $this->connect();
        $result = mysql_query($qry, $this->database_link);
        if ($result) {
            $sel_true++;
            $returnArray = array();
            $i = 0;
            while ($row = mysql_fetch_array($result, MYSQL_ASSOC))
            if ($row)
                $returnArray[$i++] = $row;
            mysql_free_result($result);
            return $returnArray;
        } else {
            $sel_false++;
            return false;
        }
    }
}

?>