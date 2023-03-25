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

		$match = new rencontreManager($linkpdo);
		$manager = $match->getRencontreById($dateheure,$lieu);
		if($manager['Domicile'] =="0"){
			$dom = "l'exterieur";
		}else{
			$dom = "dommicile";
		}
?>
		  <div class="title">	
			<h2>Match contre <?php echo $manager['Equipe_adverse'] ." à ". $dom;?></h2>
		</div>
		<div class="ajt">
		<form action="modifScore.php" method="post">
			<label for="sc">Nombre de But de mon equipe</label>
			<input  type ="number" name="sc" min="0" max="99" step="1" value="<?php echo $manager['Score_domicile'];?>"/><br>
			
			<label for="sc2">Nombre de But de <?php echo $manager['Equipe_adverse'];?></label>
			<input  type ="number" name="sc2" min="0" max="99" step="1"  value="<?php echo $manager['Score_exterieur'];?>" /><br>
			
			<input name="d" type="hidden" value="<?php echo $dateheure; ?>" />
			<input name="l" type="hidden" value="<?php echo $lieu; ?>" />
			
			<input  type ="submit" name="en"/>
		</form>
			</div>
	<?php 
?>

		 <div class="title">	
					<h2> Ajouter Note et Commentaire</h2>
				</div>
		<div class="listed">
			<form  class = "form" action="AjouterNoteCom.php" method="post" >		
			<label for="jou">Joueur</label>
			<select name="jou">
			  <?php
				//met dans une liste deroulante tout les joueurs
				$manager = new participationManager($linkpdo);
				$joueurs = $manager->getAllParticipe($dateheure,$lieu);
				foreach($joueurs as $joueur) {

				$valeur = $joueur['N_licence'];
				$affiche =$joueur['Prenom']." ".$joueur['Nom']." ".$joueur['Poste']." ".$joueur['Taille']."m ".$joueur['Poids']."kg";
				?><option value='<?php echo $valeur;?>'><?php echo $affiche; ?></option><?php } ?>
			</select><br>
			<label for="note">Note</label><br>
			<input type ="number" name="note" min="0" max="10" step="0.5"/><br>
			<label for="com">Commentaire</label><br>
			<textarea name="com" rows="4" cols="50%" ></textarea> <br>
			<input name="d" type="hidden" value='<?php echo $dateheure; ?>'>
			<input name="l" type="hidden" value='<?php echo $lieu; ?>'>
			
			<input  type ="submit" name="en"/>
			</form>	
		</div>

<style>


.listed{
	background-color:#FFD4D4;
	padding:2%;
	margin: 0 auto;
	width:50%;
	
}
.ajj{
	display:flex;
	flex-direction: column;
    align-items: center;
}

input[type=text], select, input[type=date],input[type=file],input[type=number]{
  width: 100%;
  padding:4px;
  border: 2px solid white; 
  border-radius: 4px; 
  box-sizing: border-box; 


}

input[type=submit] {
  width: 35%;
  background-color: #04AA6D;
  color: white;
  padding: 2%;
  border: none;
  border-radius: 4px;
  cursor: pointer;
   margin-top:2%;
   
}

.ajt{
	background-color:#FFD4D4;
	padding:2%;
	margin: 0 auto;
	width:50%;
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