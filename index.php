<?php

    // Auto chargement des classes
    spl_autoload_register(function($class)
        {
            require_once($class. '.php');
        }
    );



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



    $joueur = new Joueur('1234567890','Zidane', 'Zinedine', 'linkphoto', '23/06/1972', 1.85, 82.50, 'Milieu', statut::statut_actif);
    $joueur2 = new Joueur('0987654321','Neymar', 'Jr', 'linkphoto', '05-02-1992', 1.80, 71.00, 'Attaquant', statut::statut_blesse);

    $manager = new joueurManager($linkpdo);
    $manager->add($joueur2);
    print_r($manager->getUserById('0987654321'));
    $manager->delUserById('0987654321');
    print_r($manager->getAll());

    //ERREUR GETUSERBYNAME
    print($manager->getUserByName('Zidane'));

?>