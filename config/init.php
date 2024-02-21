<?php
//page de connexion à la bdd

//gestion des erreurs php
ini_set('display_errors', 1);
error_reporting(E_ALL);

//configuration bdd
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,//affichage des erreurs, en prod on utilisera ERRMODE_SILENT pour des raisons de sécurité
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',//définition du charset
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,//récupération des données sous la forme d'un tableau associatif
];

//définition d'une constante nommée CONNECTBDD qui relie php & bdd
define('CONNECTBDD',array(
    'type'=>'mysql',//type de le bdd
    'host'=>'localhost',//hôte de la bdd
    'user'=>'root',//utilisateur
    'pass'=>'',//mdp vide sous windows
    'database'=>'galerie_photo'//nom de la bdd exploitée
));

//try and catch pour tester le code et détecter les potentielles erreurs
try{
    //création d'une instance $pdo pour la class PDO qui relie une bdd sql à un fichier php
    $pdo = new PDO(CONNECTBDD['type'] . ':host=' . CONNECTBDD['host'] . ';dbname=' . CONNECTBDD['database'],CONNECTBDD['user'],CONNECTBDD['pass'],$options);
}catch(PDOException $e){
    //PDOException = class qui représente les erreurs émises par la class PDO
    //$e = objet de la class PDO
    die('<p>Erreur lors de la connexion à la base de données : ' . $e->getMessage() . '</p>');
    //getMessage = méthode de la class PDOException qui s'applique à l'objet
}