<?php
include("objets/rencontre.php");
include("objets/rencontreManager.php");
include("objets/participer.php");
include("objets/participationManager.php");
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

?>

<html>
<head>
	<title>Authentification</title>
</head>
<body>
<div>
    <ul class="menu">
      <li><a href="accueil.php">Accueil</a></li>
      <li><a href="ajouter.php">Ajouter un Joueur</a></li>
      <li><a href="match.php">Matchs</a></li>
	  <li><a href="#docs">Docs</a></li>
    </ul>
  </div>	
  <div class="ajj">	
	<h1><a href="ajouterMatch.php">Ajouter un Match</a></h1>
</div>
<div class="title">	
	<h2> Liste des Matchs </h2>
</div>	
<table class="tab">

	<tr>
		<th>Feuille de Match</th>
		<th>Adversaire</th>
		<th>Score</th>
		<th>Date et Heure</th>
		<th>Lieu</th>
		<th>Dommicile</th>
		<th>Supprimer</th>
	</tr>
	<?php
		///Exécution d’une requête SELECT sur le serveur MySQL
		$res = $linkpdo->query('SELECT * FROM rencontre');
		while ($truc = $res->fetch()) {
			echo '<tr>'.
				'<td><a href="FeuilleMatch.php?dateh='.$truc["Dateheure_match"].'&lieur='.$truc['Lieu_rencontre'].'"><img src="feuille.png" alt="icone feuille de match" width=40em /></a></td>'.
				'<td>'.$truc['Equipe_adverse'].'</td>'?>
				<?php
				$total = new participationManager($linkpdo);
				$count = $total->countAllParticipe($truc["Dateheure_match"],$truc['Lieu_rencontre']);
				if ($count >=3){
					echo ('<td><a href="Score.php?dateh='.$truc["Dateheure_match"].'&lieur='.$truc['Lieu_rencontre'].'">'.$truc['Score_domicile'].'-'.$truc['Score_exterieur'].'</a></td>');
				}else{
					echo ('<td> faire la feuille de match </td>');
				}?>
				<?php
				echo '<td>'.$truc['Dateheure_match'].'</td>'.
				'<td>'.$truc['Lieu_rencontre'].'</td>'.
				'<td>'.$truc['Domicile'].'</td>'.
				'<td><a href="deleteMatch.php?dateh='.$truc["Dateheure_match"].'&lieur='.$truc['Lieu_rencontre'].'"><img src="effacer.png" alt="icone supprimer" width=40em /></a></td>'.
			'</tr>';
		}
		$res->closeCursor();
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