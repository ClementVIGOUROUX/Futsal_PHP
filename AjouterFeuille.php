<?php
include("objets/rencontre.php");
include("objets/rencontreManager.php");
include("objets/participer.php");
include("objets/participationManager.php");


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
	
	if (isset($_POST['titulaire'])){
		$titu = $_POST['titulaire'];
	}else{
		$titu = "0";
	}
	
	
	$participer = new participer('a',$titu,'0','0','0',$lic,$dateheure,$lieu);
	$manager = new participationManager($linkpdo);
	$manager->add($participer);
	header("Location:FeuilleMatch.php?dateh=".$dateheure."&lieur=".$lieu); 
?>