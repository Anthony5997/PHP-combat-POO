<?php
try
{
    $bdd = new PDO('mysql:host=127.0.0.1:3306;dbname=character_fighter','root','', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (Exception $e)
{
    die('Erreur : ' .$e->getMessage())  or die(print_r($bdd->errorInfo()));
}
