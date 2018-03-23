<?php

session_start(); // Permet de créer une session ou d'en ouvrir une si elle existe
$_SESSION['login'] = 'Grumf'; // Créé un fichier dans tmp sur le serveur

echo '<pre>';

var_dump($_SESSION);
var_dump($_COOKIE);
echo '</pre>';

?>