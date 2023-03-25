<?php 
include("objets/rencontre.php");
include("objets/rencontreManager.php");
include("objets/participationManager.php");
include("objets/joueur.php");
include("objets/joueurManager.php");
include("objets/participer.php");


	$server="localhost";
    $login="root";
    $mdp='';
    $db ="db_futsal";

    try {
        $linkpdo = new PDO("mysql:host=$server;dbname=$db", $login, $mdp);
    }
    catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
	
$lieu = $_POST['l'];
$dateheure = $_POST['d'];
$sc1 =$_POST['sc'];
$sc2 = $_POST['sc2'];

echo $dateheure;
$rencontre = new rencontreManager($linkpdo);
$rencontre->updateScore($dateheure,$lieu,$sc1,$sc2);

header("Location:Score.php?dateh=".$dateheure."&lieur=".$lieu);

 ?>