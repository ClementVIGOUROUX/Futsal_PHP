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
	
	
	 if($_GET){   
		$dateheure = $_GET['dateh'];
		$lieu = $_GET['lieur'];
    }else{
      echo "Url has no user";
    }

		
		
		
		
				


?>
<html>
<head>
	<title>Feuille de Match</title>
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
  
  

  
<?php

		$total = new participationManager($linkpdo);
		$count = $total->countAllParticipe($dateheure,$lieu);
		
	if ($count <= 14){
			?>
		  <div class="title">	
			<h2> Ajouter les Joueurs</h2>
		</div>
		<div class="listed">
			<form  class = "form" action="AjouterFeuille.php" method="post" >		
			<label for="jou">Joueurs</label>
			<select name="jou">
			  <?php
				//met dans une liste deroulante tout les joueurs
				$manager = new joueurManager($linkpdo);
				$joueurs = $manager->getActif();
				
				foreach($joueurs as $joueur) {
					
				$valeur = $joueur['N_licence'];
				$affiche =$joueur['Prenom']." ".$joueur['Nom']." ".$joueur['Poste']." ".$joueur['Taille']."m ".$joueur['Poids']."kg";
				?><option value='<?php echo $valeur;?>'><?php echo $affiche; ?></option><?php } ?>
			</select>
			<input type="checkbox" name="titulaire" value="1">
			<label for="titulaire"> Titulaire</label><br>
			<input name="d" type="hidden" value='<?php echo $dateheure; ?>'>
			<input name="l" type="hidden" value='<?php echo $lieu; ?>'>
			
			<input  type ="submit" name="en"/>
			</form>	
			</div>
	<?php 
	}
?>
	
	
	
	
	
<div class="title">	
	<h2> Joueurs </h2>
</div>	
<table class="tab">
	<tr>
		<th>Photo</th>
		<th>Nom</th>
		<th>Prénom</th>
		<th>Poste</th>
		<th>Taille</th>
		<th>Poids</th>
		<th>Numéro de licence</th>
	</tr>
	<?php
		//liste tout les joueurs qui sont dans la feuille de match dans un tableau
		// faire en sorte qu'il puisse en avoir que 5 + 9 avec un count 
		$liste = new participationManager($linkpdo);
		$titu = $liste->getAllParticipe($dateheure,$lieu);
		foreach($titu as $player) {
			echo '<tr>'.
				'<td>'.$player['Photo'].'</td>'.
				'<td>'.$player['Nom'].'</td>'.
				'<td>'.$player['Prenom'].'</td>'.
				'<td>'.$player['Poste'].'</td>'.
				'<td>'.$player['Taille'].'</td>'.
				'<td>'.$player['Poids'].'</td>'.
				'<td>'.$player['N_licence'].'</td>'.
			'</tr>';
		}
		?></table>
<style>


.listed{
	display:flex;
	justify-content:center;
	
}
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