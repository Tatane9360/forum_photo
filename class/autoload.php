<?php
//fichier permettant de créer une fonction d'autoload afin d'appeler automatiquement nos class sans avoir à les appeler une à une

//enregistre une fonction en qu'implémentation de __autoload() qui permet de charger une classe
//paramètre = fonction anonyme
spl_autoload_register(function($nomDeLaClass){
    //inclusion de la class
    include $nomDeLaClass . '.class.php';
});