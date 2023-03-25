
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


	//if(!empty($_POST['nu'])){
		//if(strlen($_POST['nu']) < 10 ){
			//echo '<script>alert("le numéro de licence doit contenir 10 caractères")</script>';
		//}else{
			
			
		if((!empty($_POST['n'])) && (!empty($_POST['prenom'])) && (!empty($_POST['ph'])) && (!empty($_POST['t'])) && (!empty($_POST['p'])) && (!empty($_POST['po'])) && (!empty($_POST['s'])) && (!empty($_POST['nu'])) && (!empty($_POST['d']))){	
			
			$nom = $_POST['n'];
			$prenom = $_POST['prenom'];
			$photo = $_POST['ph'];
			$taille = str_replace(",",".",$_POST['t']);
			$poids = str_replace(",",".",$_POST['p']);
			$poste = $_POST['po'];
			$statut = $_POST['s'];
			$nlic = $_POST['nu'];
			$date = $_POST['d'];

			$joueur = new Joueur($nlic,$nom,$prenom,$photo,$date,$taille,$poids,$poste,$statut);
			$manager = new joueurManager($linkpdo);
			$manager->add($joueur);
			
			echo '<script>alert("Le joueur a bien été ajouté")</script>';
			
		}else{
			//echo '<p>Veuillez renseigner tous les champs</p>';
			echo '<script>alert("Veuillez renseigner tous les champs")</script>';
		}
?>	
<div class="ajt">

	<form  action="ajouter.php" method="post" >
			<label for="ph">Photo <b>*</b></label>
			<input  type ="file" name="ph"/>
			
			<label for="n">Nom <b>*</b></label>
			<input  type ="text" name="n" maxlength="20"/>
			
			<label for="prenom">Prenom <b>*</b></label>
			<input  type ="text" name="prenom" maxlength="20"/>
			
			<label for="t">Taille <b>*</b></label>
			<input  type ="number" name="t" min="0.70" max="3" step="0.01"/>
			
			<label for="p">Poids <b>*</b></label>
			<input  type ="number" name="p" min="20" max="300" step="0.01"/>
			
			<label for="po">Poste <b>*</b></label>
			<select name="po">
			<option value="UNIVERSEL">UNIVERSEL</option>
			<option value="GARDIEN">GARDIEN</option>
			<option value="DEFENSEUR">DEFENSEUR</option>
			<option value="AILIER">AILIER</option>
			<option value="PIVOT">PIVOT</option>
			</select>	
			
			<label for="s">Statut <b>*</b></label>
			<select name="s">
			<option value="ACTIF">ACTIF</option>
			<option value="BLESSE">BLESSE</option>
			<option value="SUSPENDU">SUSPENDU</option>
			<option value="ABSENT">ABSENT</option>
			</select>
		
			<label for="nu">Numéro de licence (10 Caracteres )<b>*</b></label>
			<input  type ="text" name="nu" maxlength="10"/>
			
			<label for="d">Date de Naissance<b>*</b></label>
			<input  type ="date" name="d"/>
			
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