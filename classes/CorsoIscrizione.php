<?php

require_once 'db.php';
require_once 'Utils.php';

/**
 * Description of CorsoIscrizione
 *
 * @author sixs
 */
class CorsoIscrizione {

    var $id;
    var $corso_id;
    var $socio_id;
    var $classe_id;
    var $pagato;
    var $note;
    var $data_iscrizione;
    
    function getData_iscrizione() {
        return $this->data_iscrizione;
    }
    
    function getData_iscrizione_display() {
        return Utils::italian_date_time($this->data_iscrizione);
    }

    function setData_iscrizione($data_iscrizione) {
        $this->data_iscrizione = $data_iscrizione;
    }

    function getCorso_id() {
        return $this->corso_id;
    }

    function setCorso_id($corso_id) {
        $this->corso_id = $corso_id;
    }

    function getId() {
        return $this->id;
    }

    function getSocio_id() {
        return $this->socio_id;
    }

    function getClasse_id() {
        return $this->classe_id;
    }

    function getPagato() {
        return $this->pagato;
    }
    
    function getPagato_display() {
        if($this->pagato == 0)
        {
            return "imgs/no_pagato.png";
        }
        else
        {
            return "imgs/pagato.png";
        }
        
    }

    function getNote() {
        return $this->note;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setSocio_id($socio_id) {
        $this->socio_id = $socio_id;
    }

    function setClasse_id($classe_id) {
        $this->classe_id = $classe_id;
    }

    function setPagato($pagato) {
        $this->pagato = $pagato;
    }

    function setNote($note) {
        $this->note = $note;
    }

    public function insert()
    {
        $db = new Db();
        $conn = $db->connect();
        $res = $conn->query("INSERT INTO corso_iscrizione (corso_id, socio_id, pagato, classe_id, data_iscrizione, note) "
                . " VALUES "
                . "("
                    . "'".$conn->real_escape_string($this->getCorso_id())."', "
                    . "'".$conn->real_escape_string($this->getSocio_id())."', "
                    . "'".$conn->real_escape_string($this->getPagato())."', "
                    . "'".$conn->real_escape_string($this->getClasse_id())."', "
                    . "'".$conn->real_escape_string($this->getData_iscrizione())."', "
                    . "'".$conn->real_escape_string($this->getNote())."' "
                . ")");
        
        $conn->close();
        return $res;
    }
    
    public function update()
    {
        $db = new Db();
        $conn = $db->connect();
        $res = $conn->query("UPDATE corso_iscrizione SET "
                . " corso_id = '".$conn->real_escape_string($this->getCorso_id())."', "
                . " socio_id = '".$conn->real_escape_string($this->getSocio_id())."', "
                . " pagato = '".$conn->real_escape_string($this->getPagato())."', "
                . " classe_id = '".$conn->real_escape_string($this->getClasse_id())."', "
                . " data_iscrizione = '".$conn->real_escape_string($this->getData_iscrizione())."', "
                . " note = '".$conn->real_escape_string($this->getNote())."' "
                . " WHERE "
                . " id = ".$this->getId());
        $conn->close();
        return $res;
    }
    
    public function delete()
    {
        $db = new Db();
        $conn = $db->connect();
        $res = $conn->query("DELETE FROM corso_iscrizione WHERE id = ".$this->getId());
               
        $conn->close();
        return $res;
    }
    
    static function get_object_from_db($row)
    {
        $corso_iscrizione = new CorsoIscrizione();
        $corso_iscrizione->setId($row["id"]);
        $corso_iscrizione->setCorso_id($row["corso_id"]);
        $corso_iscrizione->setSocio_id($row["socio_id"]);
        $corso_iscrizione->setPagato($row["pagato"]);
        $corso_iscrizione->setClasse_id($row["classe_id"]);
        $corso_iscrizione->setNote($row["note"]);
        $corso_iscrizione->setData_iscrizione($row["data_iscrizione"]);
        
        return $corso_iscrizione;
    }
    
    static function get_all_corso_iscrizione()
    {
        $corso_iscrizione = null;
        $db = new Db();
        $conn = $db->connect();
        
        $sql = "SELECT * FROM corso_iscrizione ORDER BY data_iscrizione";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $corso_iscrizione[$row["id"]] = CorsoIscrizione::get_object_from_db($row);
            }
        } 
        $conn->close();
        return $corso_iscrizione;
    }
    
    static function get_by_id($id)
    {
        $corso_iscrizione = null;
        $db = new Db();
        $conn = $db->connect();
        
        $sql = "SELECT * FROM corso_iscrizione WHERE id =".$id;
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $corso_iscrizione = CorsoIscrizione::get_object_from_db($row);
            }
        } 
        $conn->close();
        return $corso_iscrizione;
    }
    
    static function get_by_corso_elemento_id($corso_elemento_id)
    {
        $corso_iscrizione = null;
        $db = new Db();
        $conn = $db->connect();
        
        $sql = "SELECT * FROM corso_iscrizione WHERE corso_id =".$corso_elemento_id;
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $corso_iscrizione[$row["id"]] = CorsoIscrizione::get_object_from_db($row);
            }
        } 
        $conn->close();
        return $corso_iscrizione;
    }
}
