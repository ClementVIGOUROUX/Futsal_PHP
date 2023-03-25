<?php

class joueurManager {

    // a voir si on peut recuperer la variable linkpdo a l'interieur de la classe comme ci-dessous
   // const db = $linkpdo ;


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

    public function add(Joueur $joueur) {
        $query = $this->_db->prepare('INSERT INTO joueur VALUES (:nLicence, :nom, :prenom, :photo, :date_Naissance, :taille, :poids, :poste, :statut)');
        if ($query == false) {
            die('Erreur prepare in add function');
        }
        $query->bindValue(':nLicence', $joueur->getNLicence());
        $query->bindValue(':nom', $joueur->getNom());
        $query->bindValue(':prenom', $joueur->getPrenom());
        $query->bindValue(':photo', $joueur->getPhoto());
        $query->bindValue(':date_Naissance', $joueur->getDateNaissance());
        $query->bindValue(':taille', $joueur->getTaille());
        $query->bindValue(':poids', $joueur->getPoids());
        $query->bindValue(':poste', $joueur->getPoste());
        $query->bindValue(':statut', $joueur->getStatut());
        $query->execute();
    }




    public function getUserById($nLicence) {
        $query = $this->_db->query('SELECT N_licence, Nom, Prenom, Photo, Date_Naissance, Taille, Poids, Poste, Statut FROM joueur WHERE N_licence = '. $nLicence);
        $donnees = $query->fetch(PDO::FETCH_ASSOC);
        return new Joueur($donnees['N_licence'], $donnees['Nom'], $donnees['Prenom'], $donnees['Photo'], $donnees['Date_Naissance'],
        $donnees['Taille'], $donnees['Poids'], $donnees['Poste'], $donnees['Statut']) ;
        

    }

    public function getUserByName($nom) {
        $query2 = $this->_db->query('SELECT * FROM joueur WHERE Nom = '. $nom);

        if ($query2 == false) {
            die('Error getUserByName');
        }

        $donnees2 = $query2->fetch(PDO::FETCH_ASSOC);
        return $donnees2;
        //if (this->nom === $nom) {
            //return this->joueur ;
        //}
    }

    public function getAll() {
        $joueurs = [];
        $query3 = $this->_db->query('SELECT Photo, Nom, Prenom, Taille, Poids, Poste, Statut, N_licence, Date_naissance FROM joueur ORDER BY Nom');

        while($donnees3 = $query3->fetch(PDO::FETCH_ASSOC)) {
            $joueurs[] = $donnees3;
        }
        return $joueurs ;

    } 


    public function getActif() {
        $joueurs = [];
        $query5 = $this->_db->query('SELECT Photo, Nom, Prenom, Taille, Poids, Poste, Statut, N_licence, Date_naissance FROM joueur Where Statut = "ACTIF"');

        while($donnees4 = $query5->fetch(PDO::FETCH_ASSOC)) {
            $joueurs[] = $donnees4;
        }
        return $joueurs ;

    } 

    public function updateJoueur(Joueur $joueur) {
        
        $query4 = $this->_db->prepare('UPDATE joueur  SET Nom = :nvnom, Prenom  = :nvprenom , Photo  = :nvphoto , Taille = :nvtaille , Poids  = :nvpoids , Poste  = :nvposte , Statut = :nvstatut , Date_naissance  = :ndate WHERE N_licence = :licence');
        $query4->bindValue(':nvnom', $joueur->getNom());
        $query4->bindValue(':nvprenom', $joueur->getPrenom());
        $query4->bindValue(':nvphoto', $joueur->getPhoto());
        $query4->bindValue(':nvtaille', $joueur->getTaille());
        $query4->bindValue(':nvphoto', $joueur->getPhoto());
        $query4->bindValue(':nvpoids', $joueur->getPoids());
        $query4->bindValue(':nvposte', $joueur->getPoste());
        $query4->bindValue(':nvstatut', $joueur->getStatut());
        $query4->bindValue(':ndate', $joueur->getDateNaissance());
        $query4->bindValue(':licence', $joueur->getNLicence());
        $query4->execute();


        if($query4->rowCount()>0){
            echo'<script>alert("Modification effectuée")</script>';
        }

    }


    public function delUserById($nLicence) {
        $query4 = $this->_db->exec('DELETE FROM joueur WHERE N_licence = '. $nLicence);
        if ($query4 == false) {
            die('Error delUserById');
        }
    }


}

?>