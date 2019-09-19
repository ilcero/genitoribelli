<?php

require_once 'db.php';
require_once 'Utils.php';

/**
 * Description of Socio
 *
 * @author sixs
 */
class SocioTesseramento {
    
    var $id;
    var $socio_id;
    var $data_inizio;
    var $data_fine;
    var $note;
    
    function getSocio_id() {
        return $this->socio_id;
    }

    function getData_inizio() {
        return $this->data_inizio;
    }

    function getData_fine() {
        return $this->data_fine;
    }

    function setSocio_id($socio_id) {
        $this->socio_id = $socio_id;
    }

    function setData_inizio($data_inizio) {
        $this->data_inizio = $data_inizio;
    }

    function setData_fine($data_fine) {
        $this->data_fine = $data_fine;
    }
    function getNote() {
        return $this->note;
    }

    function setNote($note) {
        $this->note = $note;
    }

            
    function getId() {
        return $this->id;
    }
    function setId($id) {
        $this->id = $id;
    }

        
    public function insert()
    {
        $db = new Db();
        $conn = $db->connect();
        $res = $conn->query("INSERT INTO socio_tesseramento (socio_id, data_inizio, data_fine, note) "
                . " VALUES "
                . "("
                    . "'".$this->getSocio_id()."', "
                    . "'".$this->getData_inizio()."', "
                    . "'".$this->getData_fine()."', "
                    . "'".$conn->real_escape_string($this->getNote())."'"
                . ")");
        $conn->close();
        return $res;
    }
    
    public function update()
    {
        $db = new Db();
        $conn = $db->connect();
        $res = $conn->query("UPDATE socio_tesseramento SET "
                . " socio_id = '".$this->getData_nascita()."', "
                . " data_inizio = '".$this->getData_nascita()."', "
                . " data_fine = '".$this->getData_nascita()."', "
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
        $res = $conn->query("DELETE FROM socio_tesseramento WHERE id = ".$this->getId());
               
        $conn->close();
        return $res;
    }
    
    static function get_object_from_db($row)
    {
        $socio = new SocioTesseramento();
        $socio->setId($row["id"]);
        $socio->setSocio_id($row["socio_id"]);
        $socio->setData_inizio($row["data_inizio"]);
        $socio->setData_fine($row["data_fine"]);
        $socio->setNote($row["note"]);
        
        return $socio;
    }
    
    static function get_by_socio_id($socio_id)
    {
        $tess = null;
        $db = new Db();
        $conn = $db->connect();
        
        $sql = "SELECT * FROM socio_tesseramento WHERE socio_id =".$socio_id." ORDER BY data_inizio DESC";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $tess[$row["id"]] = SocioTesseramento::get_object_from_db($row);
            }
        } 
        $conn->close();
        return $tess;
    }
}
