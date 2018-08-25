<?php
session_start();
if(array_key_exists("account_id", $_SESSION) == "")
{
    header("location: login.php");
}
?>
