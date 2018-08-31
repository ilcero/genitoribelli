<?php
require_once 'db.php';
require_once 'Utils.php';

/**
 * Description of SocioParentela
 *
 * @author sixs
 */
class SocioParentela {
    var $id;
    var $socio_id;
    var $parente_id;
    var $parentela;
    
    function getId() {
        return $this->id;
    }

    function getSocio_id() {
        return $this->socio_id;
    }

    function getParente_id() {
        return $this->parente_id;
    }

    function getParentela() {
        return $this->parentela;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setSocio_id($socio_id) {
        $this->socio_id = $socio_id;
    }

    function setParente_id($parente_id) {
        $this->parente_id = $parente_id;
    }

    function setParentela($parentela) {
        $this->parentela = $parentela;
    }
    
    public function insert()
    {
        $db = new Db();
        $conn = $db->connect();
        $res = $conn->query("INSERT INTO socio_parentela (socio_id, parente_id, parentela) "
                . " VALUES "
                . "("
                    . "'".$this->getSocio_id()."', "
                    . "'".$this->getParente_id()."', "
                    . "'".$this->getParentela()."' "
                . ")");
        $conn->close();
        return $res;
    }
    
    public function delete()
    {
        $db = new Db();
        $conn = $db->connect();
        $res = $conn->query("DELETE FROM socio_parentela WHERE id = ".$this->getId());
               
        $conn->close();
        return $res;
    }
    
    static function get_object_from_db($row)
    {
        $socio_parentela = new SocioParentela();
        $socio_parentela->setId($row["id"]);
        $socio_parentela->setSocio_id($row["socio_id"]);
        $socio_parentela->setParente_id($row["parente_id"]);
        $socio_parentela->setParentela($row["parentela"]);
        
        return $socio_parentela;
    }
    
    static function get_by_socio($id)
    {
        $socio_parentela = null;
        $db = new Db();
        $conn = $db->connect();
        
        $sql = "SELECT * FROM socio_parentela WHERE socio_id =".$id;
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $socio_parentela[$row["id"]] = SocioParentela::get_object_from_db($row);
            }
        } 
        $conn->close();
        return $socio_parentela;
    }
    
    static function get_by_parente($id)
    {
        $socio_parentela = null;
        $db = new Db();
        $conn = $db->connect();
        
        $sql = "SELECT * FROM socio_parentela WHERE parente_id =".$id;
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $socio_parentela[$row["id"]] = SocioParentela::get_object_from_db($row);
            }
        } 
        $conn->close();
        return $socio_parentela;
    }
    
}
