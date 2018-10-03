<?php

namespace r00;

class DB{    
    private $CON;

    function __construct($host, $uname, $pass, $db){
        $this->CON = mysqli_connect($host, $uname, $pass, $db);
        if (mysqli_connect_errno())
            die("Failed to connect to the database: ".mysqli_connect_error());
    }
    
    function __destruct(){
        mysqli_close($this->CON);
    }
}

?>