<!DOCTYPE HTML>

<?php
	session_start();

	include("objets/user.php");
	include("objets/userManager.php");

	$server = 'localhost';
	$db = 'db_futsal' ;
	$mdp ='';
	$login ='root';

	//Connexion à la base de données
	try {
		$linkpdo = new PDO("mysql:host=$server;dbname=$db", $login, $mdp);
	}
		catch (Exception $e) {
		die('Erreur : ' . $e->getMessage());
	}

	

	// Création de l'objet userManager
	$userManager = new userManager($linkpdo);

	if (isset($_POST['user']) && isset($_POST['mdp'])) {
		$user = new user($_POST['user'], $_POST['mdp']);
		$password = $userManager->getUserPassword($user->getLogin());

		if (password_verify($user->getPassword(), $password[0])) {
			// Connexion réussie, enregistrement de l'utilisateur en session
			$_SESSION['user'] = $user;
			header('Location: accueil.php');
			exit();
		} else {

			// Connexion échouée, affichage d'un message d'erreur
			echo '<script>alert("Votre mot de passe est incorrect")</script>';
		}
	}
?>

<html>
<head>
	<title>Authentification</title>
</head>
	<body>
		<div class="formulaire">
			<p>Se Connecter </p>
			<form action="connexion.php" method="post" >
			<label for="user">Nom d'utilisateur</label>
			<input  type ="text" name="user"/>
			
			<label for="mdp">Mot de passe</label>
			<input  type ="password" name="mdp"/>
			
			<input  type ="submit" name="reset"/>
			</form>
		</div>
		
		

	
	
	
<style type="text/css">

body{
	background-image:url(football.png);
	background-size:cover;
	background-repeat: no-repeat;
   
}
.formulaire{
	background-color : white;
	margin-top:20%;
	margin-left: 30%;
	width: 35%;
	padding: 3em;
	display:block;
}
</style>							
	</body>
</html>