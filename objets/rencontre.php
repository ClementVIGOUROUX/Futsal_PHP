<?php

    class rencontre {

        private $dateHeure ;
        private $lieuRencontre ;
        private $equipeAdverse ;
        private $domicile ;
        private $scoreDomicile ;
        private $scoreExterieur ;
    
        public function __construct($date, $lieu, $equipeAdv, $domicile, $scoreD, $scoreE) {
            $this->dateHeure = $date ;
            $this->lieuRencontre = $lieu ;
            $this->equipeAdverse = $equipeAdv ;
            $this->domicile = $domicile ;
            $this->scoreDomicile = $scoreD ;
            $this->scoreExterieur = $scoreE ;

            
        }

        public function getDateHeure() {
            return $this->dateHeure ;
        }
    
        public function getLieuRencontre() {
            return $this->lieuRencontre ;
        }

        public function getEquipeAdverse() {
            return $this->equipeAdverse ;
        }

        public function isDomicile() {
            return $this->domicile ;
        }

        public function getScoreDomicile() {
            return $this->scoreDomicile ;
        }

        public function getScoreExterieur() {
            return $this->scoreExterieur ;
        }



       
        


    }



?>