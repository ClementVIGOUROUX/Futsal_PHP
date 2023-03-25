<?php

//FAIRE UNE CLASSE JOUEUR MANAGER AFIN DE METTRE LES METHODES AJOUT, DEL...
//ECRIRE TOUS LES GETS DE JOUEURS
//FAIRE UNE ENUM POUR STATUT (voir favoris)

class joueur {

    private $nLicence ;
    private $nom ;
    private $prenom ;
    private $photo ;
    private $date_Naissance ;
    private $taille ;
    private $poids ;
    private $poste ;
    private $statut ;

    public function __construct($nLicence, $nom, $prenom, $photo, $date_Naissance, $taille, $poids, $poste, $statut) {
        $this->nLicence = $nLicence ;
        $this->nom = $nom ;
        $this->prenom = $prenom ;
        $this->photo = $photo ;
        $this->date_Naissance = $date_Naissance ;
        $this->taille = $taille ;
        $this->poids = $poids ;
        $this->poste = $poste ;
        $this->statut = $statut ;
        
    }


    public function getNLicence() {
        return $this->nLicence ;
    }

    public function getNom() {
        return $this->nom ;
    }
    
    public function getPrenom() {
        return $this->prenom ;
    }

    public function getPhoto() {
        return $this->photo ;
    }

    public function getDateNaissance() {
        return $this->date_Naissance ;
    }

    public function getTaille() {
        return $this->taille ;
    }

    public function getPoids() {
        return $this->poids ;
    }

    public function getPoste() {
        return $this->poste ;

    }public function getStatut() {
        return $this->statut ;
    }


    public function setTaille($taille) {
        $this->taille = $taille ;
    }

    public function setPoids($poids) {
        $this->poids = $poids ;
    }

    public function setPoste($poste) {
        $this->poste = $poste;
    }

    public function setStatut($statut) {
        $this->statut = $statut ;
    }


}

abstract class statut {
    const statut_actif = 'ACTIF';
    const statut_blesse = 'BLESSE';
    const statut_suspendu = 'SUSPENDU';
    const statut_absent = 'ABSENT';
}

abstract class poste {
    const poste_gardien = "GARDIEN";
    const poste_defenseur = "DEFENSEUR";
    const poste_ailier = "AILIER";
    const poste_pivot = "PIVOT";
    const poste_universel = "UNIVERSEL"; 
}


?>