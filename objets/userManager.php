<?php

class userManager {

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




    public function getUserPassword($userlogin) {
        $req = $this->_db->prepare('SELECT COUNT(*) FROM user WHERE idlogin = :userlogin');
        $req->bindParam(':userlogin', $userlogin);
        $req->execute();
        $count = $req->fetchColumn();
        if ($count == 0) {
            // User does not exist
            echo '<script>alert("Votre nom d\'utilisateur n\'existe pas ")</script>';
            return false;
        } else {
            // User exists, continue with the password verification
            $req = $this->_db->prepare('SELECT u.id_password FROM user u WHERE idlogin = :userlogin');
            $req->bindParam(':userlogin', $userlogin);
            $req->execute();
            $row = $req->fetch();
            return $row;
        }
    }

}

?>