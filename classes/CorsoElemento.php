<?php

require_once 'db.php';
require_once 'Utils.php';

/**
 * Description of CorsoElemento
 *
 * @author andrea
 */
class CorsoElemento {
    
    var $id;
    var $nome;
    var $data_inizio;
    var $data_fine;
    var $prezzo;
    var $ora_inizio;
    var $ora_fine;
    var $giorni_settimana;
    var $note;
    var $corso_id;
    
    function getId() {
        return $this->id;
    }

    function getData_inizio() {
        return $this->data_inizio;
    }

    function getData_inizio_display() {
        return Utils::reverse_date($this->data_inizio);
    }

    function getData_fine() {
        return $this->data_fine;
    }
    
    function getData_fine_display() {
        return Utils::reverse_date($this->data_fine);
    }
    
    function getPrezzo() {
        return $this->prezzo;
    }

    function getOra_inizio() {
        return $this->ora_inizio;
    }

    function getOra_inizio_display() {
        return Utils::time_no_sec($this->ora_inizio);
    }

    function getOra_fine() {
        return $this->ora_fine;
    }

    function getOra_fine_display() {
        return Utils::time_no_sec($this->ora_fine);
    }

    function getGiorni_settimana() {
        return $this->giorni_settimana;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setData_inizio($data_inizio) {
        $this->data_inizio = $data_inizio;
    }

    function setData_fine($data_fine) {
        $this->data_fine = $data_fine;
    }

    function setPrezzo($prezzo) {
        $this->prezzo = $prezzo;
    }

    function setOra_inizio($ora_inizio) {
        $this->ora_inizio = $ora_inizio;
    }

    function setOra_fine($ora_fine) {
        $this->ora_fine = $ora_fine;
    }

    function setGiorni_settimana($giorni_settimana) {
        $this->giorni_settimana = $giorni_settimana;
    }
    
    function getNote() {
        return $this->note;
    }

    function setNote($note) {
        $this->note = $note;
    }
    
    function getNome() {
        return $this->nome;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }
    
    function getCorso_id() {
        return $this->corso_id;
    }

    function setCorso_id($corso_id) {
        $this->corso_id = $corso_id;
    }

    public function insert()
    {
        $db = new Db();
        $conn = $db->connect();
        $res = $conn->query("INSERT INTO corso_elemento (data_inizio, data_fine, prezzo, ora_inizio, ora_fine, giorni_settimana, note, nome, corso_id) "
                . " VALUES "
                . "("
                    . "'".$conn->real_escape_string($this->getData_inizio())."', "
                    . "'".$conn->real_escape_string($this->getData_fine())."', "
                    . "'".$conn->real_escape_string($this->getPrezzo())."', "
                    . "'".$conn->real_escape_string($this->getOra_inizio())."', "
                    . "'".$conn->real_escape_string($this->getOra_fine())."', "
                    . "'".$conn->real_escape_string($this->getGiorni_settimana())."', "
                    . "'".$conn->real_escape_string($this->getNote())."', "
                    . "'".$conn->real_escape_string($this->getNome())."', "
                    . "'".$conn->real_escape_string($this->getCorso_id())."' "
                . ")");
        
        $conn->close();
        return $res;
    }
    
    public function update()
    {
        $db = new Db();
        $conn = $db->connect();
        $res = $conn->query("UPDATE corso_elemento SET "
                . " data_inizio = '".$conn->real_escape_string($this->getData_inizio())."', "
                . " data_fine = '".$conn->real_escape_string($this->getData_fine())."', "
                . " prezzo = '".$conn->real_escape_string($this->getPrezzo())."', "
                . " ora_inizio = '".$conn->real_escape_string($this->getOra_inizio())."', "
                . " ora_fine = '".$conn->real_escape_string($this->getOra_fine())."', "
                . " giorni_settimana = '".$conn->real_escape_string($this->getGiorni_settimana())."', "
                . " note = '".$conn->real_escape_string($this->getNote())."', "
                . " nome = '".$conn->real_escape_string($this->getNome())."', "
                . " corso_id = '".$conn->real_escape_string($this->getCorso_id())."' "
                . " WHERE "
                . " id = ".$this->getId());
        $conn->close();
        return $res;
    }
    
    public function delete()
    {
        $db = new Db();
        $conn = $db->connect();
        $res = $conn->query("DELETE FROM corso_elemento WHERE id = ".$this->getId());
               
        $conn->close();
        return $res;
    }
    
    static function get_object_from_db($row)
    {
        $corso_elemento = new CorsoElemento();
        $corso_elemento->setId($row["id"]);
        $corso_elemento->setNome($row["nome"]);
        $corso_elemento->setData_inizio($row["data_inizio"]);
        $corso_elemento->setData_fine($row["data_fine"]);
        $corso_elemento->setPrezzo($row["prezzo"]);
        $corso_elemento->setOra_inizio($row["ora_inizio"]);
        $corso_elemento->setOra_fine($row["ora_fine"]);
        $corso_elemento->setGiorni_settimana($row["giorni_settimana"]);
        $corso_elemento->setNote($row["note"]);
        $corso_elemento->setCorso_id($row["corso_id"]);
        
        return $corso_elemento;
    }
    
    static function get_all_corso_elemento()
    {
        $corso_elemento = null;
        $db = new Db();
        $conn = $db->connect();
        
        $sql = "SELECT * FROM corso_elemento ORDER BY nome, data_inizio";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $corso_elemento[$row["id"]] = CorsoElemento::get_object_from_db($row);
            }
        } 
        $conn->close();
        return $corso_elemento;
    }
    
    static function get_by_id($id)
    {
        $corso_elemento = null;
        $db = new Db();
        $conn = $db->connect();
        
        $sql = "SELECT * FROM corso_elemento WHERE id =".$id;
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $corso_elemento = CorsoElemento::get_object_from_db($row);
            }
        } 
        $conn->close();
        return $corso_elemento;
    }
    
    static function get_by_corso_id($corso_id)
    {
        $corso_elemento = null;
        $db = new Db();
        $conn = $db->connect();
        
        $sql = "SELECT * FROM corso_elemento WHERE corso_id =".$corso_id;
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $corso_elemento[$row["id"]] = CorsoElemento::get_object_from_db($row);
            }
        } 
        $conn->close();
        return $corso_elemento;
    }
    
}
