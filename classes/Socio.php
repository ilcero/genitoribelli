<?php

include 'db.php';

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
    
    function getId() {
        return $this->id;
    }

    function getNumero_tessera() {
        return $this->numero_tessera;
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
}
