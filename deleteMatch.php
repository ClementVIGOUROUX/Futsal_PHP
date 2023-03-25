<?php
include("objets/rencontre.php");
include("objets/rencontreManager.php");


$server = 'localhost';
$db = 'db_futsal' ;
$mdp ='';
$login ='root';

try {
 $linkpdo = new PDO("mysql:host=$server;dbname=$db", $login, $mdp);
 }
 catch (Exception $e) {
 die('Erreur : ' . $e->getMessage());
 }
 
$dateheure = $_GET['dateh'];
$lieu = $_GET['lieur'];
$datee = (string)$dateheure;
$manager = new rencontreManager($linkpdo);
$manager->delRencontreById($dateheure,$lieu);
header("Location:match.php"); 
?>