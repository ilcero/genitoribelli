<?php


class Db {
    
    var $servername = "localhost";
    var $username = "root";
    var $password = "root";
    
    function getServername() {
        return $this->servername;
    }

    function getUsername() {
        return $this->username;
    }

    function getPassword() {
        return $this->password;
    }

    function setServername($servername) {
        $this->servername = $servername;
    }

    function setUsername($username) {
        $this->username = $username;
    }

    function setPassword($password) {
        $this->password = $password;
    }

    function connect()
    {
        $conn = new mysqli($this->servername, $this->username, $this->password);
        if ($conn) {
            $db_selected = mysqli_select_db($conn, 'genitoribelli');
        }
        return $conn;
    }

}

?>