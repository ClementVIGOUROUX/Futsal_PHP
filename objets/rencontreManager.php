<?php

class RencontreManager {


    //Création de l'attribut db pour la connection à la database
    private $_db;
 
    // Le constructeur appelle setDb à la création d'un objet
    public function __construct($db)
    {
        $this->setDb($db);
    }
 
    public function setDb(PDO $db)
    {
        $this->_db = $db;
    }

    public function add(Rencontre $rencontre) {
        $query = $this->_db->prepare('INSERT INTO rencontre VALUES (:dateHeure, :lieuRencontre, :equipeAdverse, :domicile,:scoreDomicile,:scoreExterieur)');
        if ($query == false) {
            die('Erreur prepare in add function');
        }
        $query->bindValue(':dateHeure', $rencontre->getDateHeure());
        $query->bindValue(':lieuRencontre', $rencontre->getLieuRencontre());
        $query->bindValue(':equipeAdverse', $rencontre->getEquipeAdverse());
        $query->bindValue(':domicile', $rencontre->isDomicile());
        $query->bindValue(':scoreDomicile', $rencontre->getScoreDomicile());
        $query->bindValue(':scoreExterieur', $rencontre->getScoreExterieur());
        $query->execute();
    }

//INSERT INTO `rencontre` (`Dateheure_match`, `Lieu_rencontre`, `Equipe_adverse`, `Domicile`, `Score_domicile`, `Score_exterieur`) VALUES ('2023-01-11 08:13:36', 'Fonsorbes', 'FFC', '0', '8', '3');


    public function getRencontreById($dateHeure, $lieuRencontre) {
        $query = $this->_db->query('SELECT * FROM rencontre WHERE dateHeure_match = "'. $dateHeure .'"AND Lieu_rencontre ="'. $lieuRencontre.'"');
        $donnees = $query->fetch(PDO::FETCH_ASSOC);
        return $donnees;
        

    }


    public function getAll() {
        $rencontres = [];
        $query3 = $this->_db->query('SELECT * FROM rencontre ORDER BY Dateheure_match');

        while($donnees3 = $query3->fetch(PDO::FETCH_ASSOC)) {
            $rencontres[] = $donnees3;
        }
        return $rencontres ;

    }

	public function delRencontreById($dateHeure, $lieuRencontre) {
			$query4 = $this->_db->exec('DELETE FROM rencontre WHERE Dateheure_match ="'.$dateHeure.'"AND Lieu_rencontre ="'.$lieuRencontre.'"');
			if ($query4 == false) {
				die('Error delUserById');
			}
		}
		
		
		
		public function updateScore($dateHeure, $lieuRencontre ,$Sc1,$Sc2) {
			$query4 = $this->_db->exec('UPDATE rencontre SET Score_domicile = "'.$Sc1.'", Score_exterieur = "'.$Sc2.'"WHERE Dateheure_match = "'.$dateHeure.'"AND Lieu_rencontre ="'.$lieuRencontre.'"');
			
		}
	
	
	
	
	public function getAllParticipe($dateHeure_match,$lieu_rencontre) {
        $participations2 = [];
        $query4 = $this->_db->query('SELECT J.* FROM joueur AS J , participer as P Where J.N_licence = P.N_licence AND P.dateHeure_match = "'.$dateHeure_match.'"AND P.Lieu_rencontre ="'.$lieu_rencontre.'"');
        while($donnees4 = $query4->fetch(PDO::FETCH_ASSOC)) {
            $participations2[] = $donnees4;
        }
        return $participations2 ;
	}
	/*
	public function delRencontreById($dateHeure, $lieuRencontre) {
		$query = $this->_db->prepare('DELETE FROM rencontre WHERE Dateheure_match = :match AND Lieu = :lieu');
		//$query->execute(['match' => $dateHeure],['lieu' => $lieuRencontre]);
		$query->execute(['match' => $dateHeure],['lieu' =>$lieuRencontre]);
		if ($query == false) {
				die('Error delUserById');
			}
    }
    */
}


?>