<?php
class participer {

    private $commentaire ;
    private $titulaire ;
    private $performance_joueur ;
    private $nb_cartonsjaunes ;
    private $carton_rouge ;
    private $nLicence ;
    private $dateheure_match ;
    private $lieu_rencontre ;

    public function __construct($commentaire, $titulaire, $performance_joueur, $nb_cartonsjaunes, $carton_rouge, $nLicence, $dateheure_match, $lieu_rencontre) {
        $this->commentaire = $commentaire ;
        $this->titulaire = $titulaire ;
        $this->performance_joueur = $performance_joueur ;
        $this->nb_cartonsjaunes = $nb_cartonsjaunes ;
        $this->carton_rouge = $carton_rouge ;
        $this->nLicence = $nLicence ;
        $this->dateheure_match = $dateheure_match ;
        $this->lieu_rencontre = $lieu_rencontre ;
        
    }


    public function getCommentaire() {
        return $this->commentaire ;
    }

    public function getTitulaire() {
        return $this->titulaire ;
    }

    public function getPerfomanceJoueur() {
        return $this->performance_joueur ;
    }

    public function getNbCartonsJaunes() {
        return $this->nb_cartonsjaunes ;
    }

    public function isCartonRouge() {
        return $this->carton_rouge ;
    }

    public function getNLicence() {
        return $this->nLicence ;
    }

    public function getDateheureMatch() {
        return $this->dateheure_match ;
    }

    public function getLieuRencontre() {
        return $this->lieu_rencontre ;

    }


}
?>