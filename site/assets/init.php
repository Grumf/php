<?php

/*
Ce fichier sera inclus dans tous les scripts pour initialiser les éléments suivants :

- Création/ouverture de session
- Connexion à la BDD
- Définition du chemin du site
- Inclusion de notre fichier utilisateur (fonction.php)
*/

// Session
session_start();

// Connexion
$pdo = new PDO('mysql:host=localhost;dbname=site','root','',
array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
));

// Chemin du site
define('RACINE_SITE','/php/site/');

$contenu='';
$contenu_gauche='';
$contenu_droite='';

// Inclusion de fichier de fonctions
require_once('fonction.php');