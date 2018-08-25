<?php
include 'db.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Account
 *
 * @author sixs
 */
class Account {
    
    var $id;
    var $username;
    var $password;
    var $admin;
    var $nome;
    var $cognome;
    
    function getId() {
        return $this->id;
    }

    function getUsername() {
        return $this->username;
    }

    function getPassword() {
        return $this->password;
    }

    function getAdmin() {
        return $this->admin;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setUsername($username) {
        $this->username = $username;
    }

    function setPassword($password) {
        $this->password = $password;
    }

    function setAdmin($admin) {
        $this->admin = $admin;
    }
    
    function getNome() {
        return $this->nome;
    }

    function getCognome() {
        return $this->cognome;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setCognome($cognome) {
        $this->cognome = $cognome;
    }

    static function get_object_from_db($row)
    {
        $account = new Account();
        $account->setId($row["id"]);
        $account->setUsername($row["username"]);
        $account->setPassword($row["password"]);
        $account->setAdmin($row["admin"]);
        $account->setNome($row["nome"]);
        $account->setCognome($row["cognome"]);
        
        return $account;
    }
    
    static function get_account_by_user_passwd($user, $passwd)
    {
        $account = null;
        $db = new Db();
        $conn = $db->connect();
        
        $sql = "SELECT * FROM account where username ='".$user."' and password = '".md5($passwd)."'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $account = Account::get_object_from_db($row);
            }
        } 
        $conn->close();
        return $account;
    }
    
}
