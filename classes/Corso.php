<?php

require_once 'db.php';
require_once 'Utils.php';

/**
 * Description of Corso
 *
 * @author sixs
 */
class Corso {
    var $id;
    var $nome;
    var $descrizione;
    var $insegnante_id;
    var $data_inizio;
    var $data_fine;
    
    function getId() {
        return $this->id;
    }

    function getNome() {
        return $this->nome;
    }
    
    function getDescrizione() {
        return $this->descrizione;
    }

    function setDescrizione($descrizione) {
        $this->descrizione = $descrizione;
    }

    function getInsegnante_id() {
        return $this->insegnante_id;
    }

    function getData_inizio() {
        return $this->data_inizio;
    }

    function getData_fine() {
        return $this->data_fine;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setInsegnante_id($insegnante_id) {
        $this->insegnante_id = $insegnante_id;
    }

    function setData_inizio($data_inizio) {
        $this->data_inizio = $data_inizio;
    }

    function setData_fine($data_fine) {
        $this->data_fine = $data_fine;
    }

    public function insert()
    {
        $db = new Db();
        $conn = $db->connect();
        $res = $conn->query("INSERT INTO corso (nome, descrizione, insegnante_id, data_inizio, data_fine) "
                . " VALUES "
                . "("
                    . "'".$conn->real_escape_string($this->getNome())."', "
                    . "'".$conn->real_escape_string($this->getDescrizione())."', "
                    . "'".$conn->real_escape_string($this->getInsegnante_id())."', "
                    . "'".$conn->real_escape_string($this->getData_inizio())."', "
                    . "'".$conn->real_escape_string($this->getData_fine())."' "
                . ")");
        $conn->close();
        return $res;
    }
    
    static function get_object_from_db($row)
    {
        $corso = new Corso();
        $corso->setId($row["id"]);
        $corso->setNome($row["nome"]);
        $corso->setDescrizione($row["descrizione"]);
        $corso->setInsegnante_id($row["insegnante_id"]);
        $corso->setData_inizio($row["data_inizio"]);
        $corso->setData_fine($row["data_fine"]);
        
        return $corso;
    }
    
    static function get_all_corso()
    {
        $corso = null;
        $db = new Db();
        $conn = $db->connect();
        
        $sql = "SELECT * FROM corso ORDER BY nome, data_inizio";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $corso[$row["id"]] = Corso::get_object_from_db($row);
            }
        } 
        $conn->close();
        return $corso;
    }
    
}
