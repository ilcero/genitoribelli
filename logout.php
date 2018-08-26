<?php
session_start();
$_SESSION["account_id"] = null;
$_SESSION["username"] = null;
$_SESSION["admin"] = null;
$_SESSION["nome"] = null;
$_SESSION["cognome"] = null;
session_destroy();

header("location: index.php");

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

