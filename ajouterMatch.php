
<html>
<head>
	<title>Ajouter un Match</title>
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
include("objets/rencontre.php");
include("objets/rencontreManager.php");


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


				
		if((!empty($_POST['a'])) && (!empty($_POST['li'])) && (!empty($_POST['do'])) && (!empty($_POST['d']))){	
			
			$adv = $_POST['a'];
			$lieu = $_POST['li'];
			$dom = $_POST['do'];
			$date = $_POST['d'];
			echo $dom;
			if(strcmp($dom,"oui")==1){
				$dom = 1;
			}else{
				$dom = 0;
			}
			
			$date = str_replace("T"," ",$_POST['d']);
			echo $date;
			$rencontre = new rencontre($date,$lieu,$adv,$dom,"0","0");
			$manager = new rencontreManager($linkpdo);
			$manager->add($rencontre);
			
			echo '<script>alert("Le match a bien été ajouté")</script>';
		}else{
			echo"<p>Veillez renseigner tous les champs</p>";
	}
?>	
<div class="ajt">

	<form  action="ajouterMatch.php" method="post" >
			<label for="n">Adversaire<b>*</b></label>
			<input  type ="text" name="a" maxlength="20"/>
			
			<label for="p">Lieu<b>*</b></label>
			<input  type ="text" name="li" min="20" max="300" step="0.01"/>
			
			<label for="d">Date et Heure<b>*</b></label>
			<input  type ="datetime-local" name="d" maxlength="20"/>
			
			<label for="do">Domicile<b>*</b></label>
			<select name="do">
			<option value="yes">oui</option>
			<option value="no">non</option>
			</select>
		
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