<?php

class participationManager {

   
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

    public function add(Participer $participation) {
        $query = $this->_db->prepare('INSERT INTO participer VALUES (:commentaire, :titulaire, :performance_participation, :nb_cartonsjaunes, :carton_rouge, :nLicence, :dateheure_match, :lieu_rencontre)');
        if ($query == false) {
            die('Erreur prepare in add function');
        }
        $query->bindValue(':commentaire', $participation->getCommentaire());
        $query->bindValue(':titulaire', $participation->getTitulaire());
        $query->bindValue(':performance_participation', $participation->getPerfomanceJoueur());
        $query->bindValue(':nb_cartonsjaunes', $participation->getNbCartonsJaunes());
        $query->bindValue(':carton_rouge', $participation->isCartonRouge());
        $query->bindValue(':nLicence', $participation->getNLicence());
        $query->bindValue(':dateheure_match', $participation->getDateheureMatch());
        $query->bindValue(':lieu_rencontre', $participation->getLieuRencontre());
        $query->execute();
    }




    public function getParticipationById($nLicence, $dateHeure_match, $lieu_rencontre) {
        $query = $this->_db->query('SELECT * FROM participation WHERE N_licence = '. $nLicence . 'AND dateHeure_match = '. $dateHeure . 'AND Lieu_rencontre ='. $lieuRencontre);
        $donnees = $query->fetch(PDO::FETCH_ASSOC);
        return $donnees;
        
        //if (this->nLicence === $nLicence) {
        // return this->participation ;
        //}

    }

    

    public function getAll() {
        $participations = [];
        $query3 = $this->_db->query('SELECT * FROM participer ORDER BY N_licence');

        while($donnees3 = $query3->fetch(PDO::FETCH_ASSOC)) {
            $participations[] = $donnees3;
        }
        return $participations ;

    }

	public function getAllParticipe($dateHeure_match,$lieu_rencontre) {
        $participations2 = [];
        $query4 = $this->_db->query('SELECT J.* FROM joueur AS J , participer as P Where J.N_licence = P.N_licence AND P.dateHeure_match = "'.$dateHeure_match.'"AND P.Lieu_rencontre ="'.$lieu_rencontre.'"');
        while($donnees4 = $query4->fetch(PDO::FETCH_ASSOC)) {
            $participations2[] = $donnees4;
        }
        return $participations2 ;

    }
   
   public function countAllParticipe($dateHeure_match,$lieu_rencontre) {
		$count = 0;
        $query5 = $this->_db->query('SELECT count(*) FROM joueur AS J , participer as P Where J.N_licence = P.N_licence AND P.dateHeure_match = "'.$dateHeure_match.'"AND P.Lieu_rencontre ="'.$lieu_rencontre.'"');
		$count = $query5->fetchColumn();
        return $count ;
   }
   
   public function updateNoteCom($dateHeure, $lieuRencontre ,$note,$com,$lic) {
			$query4 = $this->_db->exec('UPDATE participer SET Commentaire="'.$com.'",Perfomance_joueur = "'.$note.'" WHERE N_licence ="'.$lic.'" AND Dateheure_match = "'.$dateHeure.'" AND Lieu_rencontre ="'.$lieuRencontre.'"');
			
		}
   
   
}
   
?>