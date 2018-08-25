<?php
session_start();
include 'classes/account.php';

$user = $_POST["user"];
$passwd = $_POST["passwd"];
//echo $user." - ".$passwd;

$account = Account::get_account_by_user_passwd($user, $passwd);
if($account != NULL)
{
    $_SESSION["account_id"] = $account->getId();
    $_SESSION["username"] = $account->getUsername();
    $_SESSION["admin"] = $account->getAdmin();
    $_SESSION["nome"] = $account->getNome();
    $_SESSION["cognome"] = $account->getCognome();
    echo'ok';
}
else
{
    echo'AUTENTICAZIONE FALLITA';
}



/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

