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
 
 
/*
//$fonct = la fonction de clem
$data = null;

if ($data == null){
		echo"<input  type ='button' value='Ajouter un joueur'/>";
	}else{
		echo "hey";
		echo "<table class ='tab'>";
		echo" <tr><th>Photo</th><th>Nom</th><th>Prenom</th><th>Taille</th><th>Poids</th><th>Poste</th><th>Statut</th><th>N_license</th><th>Date_naissance</th></tr>";
		while ($data = $res->fetch()){
		echo"<tr>
		<td>"$data['Photo']."</td>
		<td>"$data['Nom']."</td>
		<td>"$data['Prenom']."</td>
		<td>"$data['Taille']."</td>
		<td>"$data['Poids']."</td>
		<td>"$data['Poste_prefere']."</td>
		<td>"$data['Statut']."</td>
		<td>"$data['N_license']."</td>
		<td>"$data['Date_naissance']."</td>
		</tr>";
		}
		
		$req->closeCursor();
	}	
	
*/
?>



<html>
<head>
	<title>Authentification</title>
</head>
<body>
<div>
    <ul class="menu">
      <li><a href="#home">Home</a></li>
      <li><a href="#pricing">Pricing</a></li>
      <li><a href="match.php">Mg</a></li>
	  <li><a href="#docs">Docs</a></li>
    </ul>
  </div>
<div class="ajj">	
	<h1><a href="ajouter.php">Ajouter un joueur</a></h1>
</div>
	
	
<div class="title">	
	<h2> Liste des Joueurs </h2>
</div>	
<table class="tab">
	<tr>
		<th>Photo</th>
		<th>Nom</th>
		<th>Prenom</th>
		<th>Taille</th>
		<th>Poids</th>
		<th>Poste</th>
		<th>Statut</th>
		<th>Numéro de Licence</th>
		<th>Date de Naissance</th>
		<th><img src="effacer.png" alt="icone supprimer" width=40em /></th>
	</tr>
	<?php
		///Exécution d’une requête SELECT sur le serveur MySQL
		/**$res = $linkpdo->query('SELECT * FROM joueur');
		while ($truc = $res->fetch()) {
			echo '<tr>'.
				'<td>'.$truc['Photo'].'</td>'.
				'<td><a href="infoJ.php?id='.$truc["N_licence"].'">'.$truc['Nom'].'</a></td>'.
				'<td>'.$truc['Prenom'].'</td>'.
				'<td>'.$truc['Taille'].'</td>'.
				'<td>'.$truc['Poids'].'</td>'.
				'<td>'.$truc['Poste_prefere'].'</td>'.
				'<td>'.$truc['Statut'].'</td>'.
				'<td>'.$truc['N_licence'].'</td>'.
				'<td>'.$truc['Date_naissance'].'</td>'.
				'<td><a href="delete.php?id='.$truc["N_licence"].'">Supprimer</a></td>'.
			'</tr>';
		}
		$res->closeCursor();
		?></table>

		**/

		$manager = new joueurManager($linkpdo);
		$joueurs = $manager->getAll();
		foreach($joueurs as $joueur) {
			echo '<tr>'.
			'<td>'.$joueur['Photo'].'</td>'.
			'<td><a href="infoJ.php?id='.$joueur["N_licence"].'">'.$joueur['Nom'].'</a></td>'.
			'<td>'.$joueur['Prenom'].'</td>'.
			'<td>'.$joueur['Taille'].'</td>'.
			'<td>'.$joueur['Poids'].'</td>'.
			'<td>'.$joueur['Poste'].'</td>'.
			'<td>'.$joueur['Statut'].'</td>'.
			'<td>'.$joueur['N_licence'].'</td>'.
			'<td>'.$joueur['Date_naissance'].'</td>'.
			'<td><a href="delete.php?id='.$joueur["N_licence"].'">Supprimer</a></td>'.
			'</tr>';
		}
		?></table>


<style>

.ajj{
	display:flex;
	flex-direction: column;
    align-items: center;
}


.title{
	display:flex;
	flex-direction: column;
    align-items: center;
	background-color:#5b9dd9;
	color:white;
	font-size:1.3em;
}

table th{
  font-size: 1.3em;
  padding: 1em;
  background-color: #FFD4D4;
  border: 3px solid #FFFFFF;
  text-align: center;
  text-transform: uppercase;
}

.tab td {
	background-color:#BFD6EB;
	color:black-grey;
	text-align: center;
	border: 3px solid #FFFFFF;
	font-size: 1.2em;
	padding: .5em;
	
}

.tab {
    display: flex;
    flex-direction: column;
	align-items: center;
	
}

.menu {
	display : flex;
	 justify-content: center ;
	background-color :#f16c6d;
}


.menu li {
    list-style-type: none ;       
}


.menu a {
    display:block;                
    min-width: 120px;             
	margin: 0.5rem;              
    padding: 0.4rem 0;
    text-align: center; 
	background-color:#5b9dd9;   
    color: #fff;                 
    text-decoration: none;   
}


td a{
	text-decoration: none;
	color:#EE292B;
	font-weight: bold;	
}
td a:hover {
  color:#f16c6d;
}
</style>

	
							
	</body>
</html>