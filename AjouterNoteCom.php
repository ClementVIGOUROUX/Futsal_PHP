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
	
$lic = $_POST['jou'];
$lieu = $_POST['l'];
$dateheure = $_POST['d'];
$com =$_POST['com'];
$note = $_POST['note'];

echo $com;
$rencontre = new participationManager($linkpdo);
$rencontre->updateNoteCom($dateheure,$lieu,$note,$com,$lic);

header("Location:Score.php?dateh=".$dateheure."&lieur=".$lieu);

?>