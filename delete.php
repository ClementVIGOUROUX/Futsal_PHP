<?php
include("objets/joueur.php");
include("objets/joueurManager.php");

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
 
$nLicence = $_GET['id'];
$manager = new joueurManager($linkpdo);
$manager->delUserById($nLicence);
header("Location:accueil.php"); 
?>