<?php 
include("joueur.php");
include("joueurManager.php");


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
	
$nom =$_POST['n'];
$prenom = $_POST['prenom'];
$photo = $_POST['ph'];
$taille = str_replace(",",".",$_POST['t']);
$poid = str_replace(",",".",$_POST['p']);
$poste = $_POST['po'];
$statut = $_POST['s'];
$date = $_POST['d'];
$lic = $_POST['nu'];

$prout = $lic ;

	
$req = $linkpdo->prepare('UPDATE joueur SET Nom = :nvnom , Prenom = :nvprenom , Photo = :nvphoto , Taille = :nvtaille , Poids = :nvpoid , Poste_prefere = :nvposte , Statut = :nvstatut , 
Date_naissance = :nvdate WHERE N_licence = :numl ');
$req ->execute(array(':nvnom' => $nom , ':nvprenom' => $prenom , ':nvphoto' => $photo , ':nvtaille' => $taille , ':nvpoid' => $poid ,
 ':nvposte' => $poste , ':nvstatut' => $statut , ':nvdate' => $date , ':numl' => $lic));
 header("Location:accueil.php");
?>