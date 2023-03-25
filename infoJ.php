<?php

	

?>
<html>
<head>
	<title>Ajouter un Joueur</title>
</head>
<body>
<div>
    <ul class="menu">
      <li><a href="accueil.php">Home</a></li>
      <li><a href="#pricing">Pricing</a></li>
      <li><a href="#blog">Blog</a></li>
	  <li><a href="#docs">Docs</a></li>
    </ul>
  </div>
	
<?php

	include("objets/joueur.php");
	include("objets/joueurManager.php");


	$server="localhost";
    $login="root";
    $mdp="";
    $db ="db_futsal";
	
	
	 try {
        $linkpdo = new PDO("mysql:host=$server;dbname=$db", $login, $mdp);
    }
    catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
	
	
	$manager = new joueurManager($linkpdo);
	$idJoueur = $_GET['id'];
	$userById=$manager->getUserById($idJoueur);
	

			$taille = isset($_POST['t']) ? str_replace(",",".",$_POST['t']) : $userById->getTaille();
			$poids = isset($_POST['p']) ? str_replace(",",".",$_POST['p']) : $userById->getPoids();
			$poste = isset($_POST['po']) ? $_POST['po'] : $userById->getPoste();
			$statut = isset($_POST['s']) ? $_POST['s'] : $userById->getStatut();

			if ($taille != $userById->getTaille()) {
				$userById->setTaille($taille);
			}
			
			if ($poids != $userById->getPoids()) {
				$userById->setPoids($poids);
			}
			
			if ($poste != $userById->getPoste()) {
				$userById->setPoste($poste);
			}

			if ($statut != $userById->getStatut()) {
				$userById->setStatut($statut);
			}

			//$joueurMAJ = new Joueur($userById->getNLicence(),$nom,$prenom,$userById->getPhoto(),$date,$taille,$poid,$poste,$statut);
			//print_r($joueurMAJ);
			$manager->updateJoueur($userById);
	

	//print_r($idJoueur);

	


   
			
	
			//$req = $linkpdo->prepare(UPDATE joueur SET Nom = :nvnom, Prenom  = :nvprenom , Photo  = :nvphoto , 
			//Taille = :nvtaille , Poids  = :nvpoid , Poste_prefere  = :nvposte , Statut = :nvstatut , Date_naissance  = :ndate WHERE N_licence = :licence');
			
			//$req->execute(array('nvnom' => $nom,'nvprenom' => $prenom,'nvphoto' => $photo , 'nvtaille' => $taille , 'nvpoid' => $poid , 'nvposte' => $poste
			//, 'nvstatut' => $statut , 'ndate' => $date , 'N_licence' => $test ));
		
			//echo'<script>alert("Modification fait")</script>';
		
?>	
<div class="ajt">

	<form  action="infoJ.php?id=<?php echo $idJoueur ; ?>" method="post">				
			<label for="t">Taille <b>*</b></label>
			<input  type ="number" name="t" min="0.70" max="3" step="0.01" value="<?php echo$userById->getTaille(); ?>"/>
			
			<label for="p">Poids<b>*</b></label>
			<input  type ="number" name="p" min="20" max="300" step="0.01" value="<?php echo$userById->getPoids(); ?>"/>
			
			<label for="po">Poste <b>*</b></label>
			<select name="po">
			<?php 
				switch ($userById->getPoste()) {
					case "UNIVERSEL" :
					?>
						<option value="UNIVERSEL">UNIVERSEL</option>
						<option value="GARDIEN">GARDIEN</option>
						<option value="DEFENSEUR">DEFENSEUR</option>
						<option value="AILIER">AILIER</option>
						<option value="PIVOT">PIVOT</option>
						</select>
					<?php break;
					case "GARDIEN":
					?>
						<option value="GARDIEN">GARDIEN</option>
						<option value="DEFENSEUR">DEFENSEUR</option>
						<option value="AILIER">AILIER</option>
						<option value="PIVOT">PIVOT</option>
						<option value="UNIVERSEL">UNIVERSEL</option>
						</select>
						<?php break;
					case "DEFENSEUR":
					?>
						<option value="DEFENSEUR">DEFENSEUR</option>
						<option value="GARDIEN">GARDIEN</option>
						<option value="AILIER">AILIER</option>
						<option value="PIVOT">PIVOT</option>
						<option value="UNIVERSEL">UNIVERSEL</option>
						</select>
					<?php break;
					case "AILIER":
					?>
						<option value="AILIER">AILIER</option>
						<option value="GARDIEN">GARDIEN</option>
						<option value="DEFENSEUR">DEFENSEUR</option>
						<option value="PIVOT">PIVOT</option>
						<option value="UNIVERSEL">UNIVERSEL</option>
						</select>
					<?php break;
					case "PIVOT":
						?>
							<option value="PIVOT">PIVOT</option>
							<option value="GARDIEN">GARDIEN</option>
							<option value="DEFENSEUR">DEFENSEUR</option>
							<option value="AILIER">AILIER</option>
							<option value="UNIVERSEL">UNIVERSEL</option>
							</select>
						<?php break;
			} ?>


			
			<label for="s">Statut <b>*</b></label>
			<select name="s">
			<?php 
				switch ($userById->getStatut()) {
					case "SUSPENDU" :
					?>
						<option value="SUSPENDU">SUSPENDU</option>
						<option value="ACTIF">ACTIF</option>
						<option value="BLESSE">BLESSE</option>
						<option value="ABSENT">ABSENT</option>
						</select>
					<?php break;
					case "ACTIF":
					?>
						<option value="ACTIF">ACTIF</option>
						<option value="SUSPENDU">SUSPENDU</option>
						<option value="BLESSE">BLESSE</option>
						<option value="ABSENT">ABSENT</option>
						</select>
						<?php break;
					case "BLESSE":
					?>
						<option value="BLESSE">BLESSE</option>
						<option value="ACTIF">ACTIF</option>
						<option value="SUSPENDU">SUSPENDU</option>
						<option value="ABSENT">ABSENT</option>
						</select>
					<?php break;
					case "ABSENT":
					?>
						<option value="ABSENT">ABSENT</option>
						<option value="BLESSE">BLESSE</option>
						<option value="ACTIF">ACTIF</option>
						<option value="SUSPENDU">SUSPENDU</option>
						</select>
					<?php break;
			} ?>

			
			<input  type ="submit" name="en"/>


	</form>
</div>


<style>
*{
  margin: 0;
  padding: 0;
}


p{display:flex;
justify-content:center;
background-color:#5b9dd9;	
color:white;
font-size:2em;
padding:0.77em;
margin-bottom:1em;
margin-top:0.88em;
}

body{
	background-color:#EAEAEA;
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
	background-color:   #5b9dd9;   
    color: #fff;                 
    text-decoration: none;   
}


b{
	color : red;
	font-size : 1.2em;
	position: relative;
}


</style>

	
							
</body>
</html>