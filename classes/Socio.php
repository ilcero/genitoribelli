<?php

require_once 'db.php';
require_once 'Utils.php';

/**
 * Description of Socio
 *
 * @author sixs
 */
class Socio {
    
    var $id;
    var $numero_tessera;
    var $nome;
    var $cognome;
    var $codice_fiscale;
    var $email;
    var $tel;
    var $data_nascita;
    var $note;
    
    var $data_inizio_tess_incorso;
    
    function getId() {
        return $this->id;
    }

    function getNumero_tessera() {
        return 'CG19'.str_pad($this->numero_tessera,3,'0', STR_PAD_LEFT);
    }

    function getNome() {
        return $this->nome;
    }

    function getCognome() {
        return $this->cognome;
    }

    function getCodice_fiscale() {
        return $this->codice_fiscale;
    }

    function getEmail() {
        return $this->email;
    }

    function getTel() {
        return $this->tel;
    }

    function getData_nascita() {
        return $this->data_nascita;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNumero_tessera($numero_tessera) {
        $this->numero_tessera = $numero_tessera;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setCognome($cognome) {
        $this->cognome = $cognome;
    }

    function setCodice_fiscale($codice_fiscale) {
        $this->codice_fiscale = $codice_fiscale;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setTel($tel) {
        $this->tel = $tel;
    }

    function setData_nascita($data_nascita) {
        $this->data_nascita = $data_nascita;
    }
    
    function getNote() {
        return $this->note;
    }

    function setNote($note) {
        $this->note = $note;
    }

    function getData_nascita_ita()
    {
        return Utils::reverse_date($this->data_nascita);
    }
    
    function getCognomeNome()
    {
        return $this->cognome." ".$this->nome;
    }
    
    function getData_inizio_tess_incorso() {
        return $this->data_inizio_tess_incorso;
    }
    
    function getData_inizio_tess_incorso_ita()
    {
        return Utils::reverse_date( $this->data_inizio_tess_incorso);
    }
    
    function setData_inizio_tess_incorso($data_inizio_tess_incorso) {
        $this->data_inizio_tess_incorso = $data_inizio_tess_incorso;
    }

        
    public function insert()
    {
        $db = new Db();
        $conn = $db->connect();
        $res = $conn->query("INSERT INTO socio (numero_tessera, nome, cognome, codice_fiscale, email, tel, data_nascita, note) "
                . " VALUES "
                . "("
                    . "getNuovoNumeroTessera(), "
                    . "'".$conn->real_escape_string($this->getNome())."', "
                    . "'".$conn->real_escape_string($this->getCognome())."', "
                    . "'".$conn->real_escape_string($this->getCodice_fiscale())."', "
                    . "'".$conn->real_escape_string($this->getEmail())."', "
                    . "'".$conn->real_escape_string($this->getTel())."', "
                    . "'".$this->getData_nascita()."', "
                    . "'".$conn->real_escape_string($this->getNote())."'"
                . ")");
        $this->setId($conn->insert_id);
        $conn->close();
        return $res;
    }
    
    public function update()
    {
        $db = new Db();
        $conn = $db->connect();
        $res = $conn->query("UPDATE socio SET "
                . " nome = '".$conn->real_escape_string($this->getNome())."', "
                . " cognome = '".$conn->real_escape_string($this->getCognome())."', "
                . " codice_fiscale = '".$conn->real_escape_string($this->getCodice_fiscale())."', "
                . " email = '".$conn->real_escape_string($this->getEmail())."', "
                . " tel = '".$conn->real_escape_string($this->getTel())."', "
                . " data_nascita = '".$this->getData_nascita()."', "
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
        $res = $conn->query("DELETE FROM socio WHERE id = ".$this->getId());
               
        $conn->close();
        return $res;
    }
    
    static function get_object_from_db($row)
    {
        $socio = new Socio();
        $socio->setId($row["id"]);
        $socio->setNumero_tessera($row["numero_tessera"]);
        $socio->setNome($row["nome"]);
        $socio->setCognome($row["cognome"]);
        $socio->setCodice_fiscale($row["codice_fiscale"]);
        $socio->setEmail($row["email"]);
        $socio->setTel($row["tel"]);
        $socio->setData_nascita($row["data_nascita"]);
        $socio->setNote($row["note"]);
        if(array_key_exists("data_inizio",$row))
        {
            $socio->setData_inizio_tess_incorso($row["data_inizio"]);
        }
        else
        {
            $socio->setData_inizio_tess_incorso("eeee");
        }
        return $socio;
    }
    
    static function get_all_socio()
    {
        $socio = null;
        $db = new Db();
        $conn = $db->connect();
        
        $sql = "SELECT * FROM socio ORDER BY cognome, nome";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $socio[$row["id"]] = Socio::get_object_from_db($row);
            }
        } 
        $conn->close();
        return $socio;
    }
    
    static function get_all_socio_attivo()
    {
        $socio = null;
        $db = new Db();
        $conn = $db->connect();
        
        $sql = "SELECT * FROM socio as s LEFT JOIN (select id as id_tess, data_inizio, data_fine, socio_id from socio_tesseramento WHERE now() between data_inizio AND data_fine) as tess on tess.socio_id = s.id ORDER BY cognome, nome";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $socio[$row["id"]] = Socio::get_object_from_db($row);
            }
        } 
        $conn->close();
//        print_r($socio);
        return $socio;
    }
    
    static function get_solo_attivo($data)
    {
        $socio = null;
        $db = new Db();
        $conn = $db->connect();
        
        $sql = "SELECT * FROM socio as s INNER JOIN (select id as id_tess, data_inizio, data_fine, socio_id from socio_tesseramento WHERE '".$data."' between data_inizio AND data_fine) as tess on tess.socio_id = s.id ORDER BY cognome, nome";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $socio[$row["id"]] = Socio::get_object_from_db($row);
            }
        } 
        $conn->close();
//        print_r($socio);
        return $socio;
    }
    
    static function get_by_id($id)
    {
        $socio = null;
        $db = new Db();
        $conn = $db->connect();
        
        $sql = "SELECT * FROM socio WHERE id =".$id;
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $socio = Socio::get_object_from_db($row);
            }
        } 
        $conn->close();
        return $socio;
    }
    
    static function get_num_soci()
    {
        $num = 0;
        $db = new Db();
        $conn = $db->connect();
        
        $sql = "SELECT COUNT(*) AS num FROM socio";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $num = $row["num"];
            }
        } 
        $conn->close();
        return $num;
    }
    
    static function get_num_soci_attivi($data)
    {
        $num = 0;
        $db = new Db();
        $conn = $db->connect();
        
        $sql = "SELECT COUNT(*) AS num FROM socio as s INNER JOIN (select id as id_tess, data_inizio, data_fine, socio_id from socio_tesseramento WHERE '".$data."' between data_inizio AND data_fine) as tess on tess.socio_id = s.id ORDER BY cognome, nome";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $num = $row["num"];
            }
        } 
        $conn->close();
        return $num;
    }
    
    static function get_last_tesserato()
    {
        $last_tessera = 0;
        $db = new Db();
        $conn = $db->connect();
        
        $sql = "SELECT MAX(numero_tessera) AS last_tessera FROM socio";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $last_tessera = 'CG19'.str_pad($row["last_tessera"],3,'0', STR_PAD_LEFT);
            }
        } 
        $conn->close();
        return $last_tessera;
    }
}
