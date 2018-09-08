<?php

require_once 'db.php';
require_once 'Utils.php';

/**
 * Description of Classe
 *
 * @author sixs
 */
class Classe {
    
    var $id;
    var $nome;
    
    function getId() {
        return $this->id;
    }

    function getNome() {
        return $this->nome;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    
    public function insert()
    {
        $db = new Db();
        $conn = $db->connect();
        $res = $conn->query("INSERT INTO classe (nome) "
                . " VALUES "
                . "("
                    . "'".$conn->real_escape_string($this->getNome())."', "
                . ")");
        
        $conn->close();
        return $res;
    }
    
    public function update()
    {
        $db = new Db();
        $conn = $db->connect();
        $res = $conn->query("UPDATE classe SET "
                . " nome = '".$conn->real_escape_string($this->getNome())."' "
                . " WHERE "
                . " id = ".$this->getId());
        $conn->close();
        return $res;
    }
    
    public function delete()
    {
        $db = new Db();
        $conn = $db->connect();
        $res = $conn->query("DELETE FROM classe WHERE id = ".$this->getId());
               
        $conn->close();
        return $res;
    }
    
    static function get_object_from_db($row)
    {
        $classe = new Classe();
        $classe->setId($row["id"]);
        $classe->setNome($row["nome"]);
        
        return $classe;
    }
    
    static function get_all()
    {
        $classe = null;
        $db = new Db();
        $conn = $db->connect();
        
        $sql = "SELECT * FROM classe ORDER BY nome";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $classe[$row["id"]] = Classe::get_object_from_db($row);
            }
        } 
        $conn->close();
        return $classe;
    }
    
    static function get_by_id($id)
    {
        $classe = null;
        $db = new Db();
        $conn = $db->connect();
        
        $sql = "SELECT * FROM classe WHERE id =".$id;
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $classe = Classe::get_object_from_db($row);
            }
        } 
        $conn->close();
        return $classe;
    }
    
}
