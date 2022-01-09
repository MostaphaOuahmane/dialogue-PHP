<?php 
// 2 CONNEXION BDD dialogue
$pdoDIA = new PDO( 'mysql:host=localhost;dbname=dialogue-php',// hôte nom BDD
              'root',// pseudo 
              // '',// mot de passe
              '',// mdp pour MAC avec MAMP
              array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,// afficher les erreurs SQL dans le navigateur
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',// charset des échanges avec la BDD
              ));
        ?>     