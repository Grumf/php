<?php

// Synthèse
// Variables affectation
$variable1 = 5;
$variable2 = 'chaine';

// constante
define('CONSTANTE', '42');

// tableau
$tab = array();
$tab[] = 1;
$tab[] = 2;
echo $tab[0]; // 1
echo $tab[1]; // 2
$tab['toto'] = 'titi';
echo $tab['toto']; // titi

// Boucles
// While
$i = 0; // init
while ( $i > 10 ){ // Condition d'arrêt de la boucle
    echo $i;
    $i++; // Incrémentation
}

// foreach (spécial tableau et objet)
foreach ( $tab as $index => $value ){
    // Je parcoure le tableau, j'ai le nom de l'indice et sa valeur
}

// Fonctions
// Permet de répéter une série d'instructions en appelant la fonction
function miseAuCarre($nombre){
    return $nombre*$nombre;
}

echo miseAuCarre(4); // 16

function addition($a, $b = 10){

    return $a + $b;
}

echo addition(2,3) // 5
echo addition(7) // 17

// Objets
// ex : PDO
$madate = new DateTime;
echo $madate->format('Y-m-d H:i:s');

$madate2 = new DateTime('2018-01-31 15:42:23');

$madate3 = new DateTime;
$madate3->setTimestamp(mktime(15,42,23,1,31,2018));
echo $madate3->format('d/m/Y');

// Inclusion de fichier
require_once('autrefichier.php');

// Connaitre le type d'une variable
echo gettype($variable1); // integer

// Concaténation
echo 'le debut d\'une chaine '.$variable1.' et la fin de la chaine';
echo "une chaine avec la variable $variable1 interprétée entre guillemets";
echo " une chaine ".$variable2." aussi concaténée";

// SQL

$options = array( PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
                  PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');

$db = new PDO('mysql:host=localhost;dbname=bibliotheque','root','', $options );

$db->exec("INSERT INTO ...");
$db->exec("UPDATE ...");
$db->exec("DELETE ...");

$resul = $db->query("SELECT ...");
// pour 1 resultat
$ligne = $resul ->fetch(PDO::FETCH_ASSOC);
// pour plusieurs résultats
while ( $ligne = $resul ->fetch(PDO::FETCH_ASSOC) )
{
    echo $ligne['colonne'];
}

// requete avec préparation/exécution
$valeur = 'valeur';
$db->prepare("SELECT .... :param ....");
$db->execute(array( 'param' => $valeur ));


$var3 = $db->lastInsertId(); // <Renvoie le dernier id inséré ex : $db->query("INSERT INTO...);

// Super globale

$_POST // Tableau qui contient les 'names' des "input, select, radio, etc..." d'un formulaire associé à leurs valeurs si la méthode est POST

$_GET // Tableau qui contient les entrées dans l'url qui suivent le "?"
// ex : index.php?action=modifier&id_produit=5
// On aura $_GET['action'] qui vaut "modifier"
// et $_GET['id_produit'] qui vaut 5

$_FILES // Tableau qui contient les infos des fichiers uploadés sur un formulaire
// <form method="post" action="" enctype="multipart/form-data">

$_SESSION // Je dois avoir initialisé la session avec session_start()
          //  /!\ cela crée un cookie PHPSESSID pour relier au fichier de session stocké sur le serveur dans le répertoire /tmp

$_COOKIES // Tableau stocké coté client dans ses cookies de son navigateur.


// Conditions

if ( condition ){

}
else{

}

// autre forme
if ( condition ):

else :

endif;

// switch
switch( $chiffre ) {

case 1: ... ; break;
case 2: ... ; break;
default: ... ; break;

}

// Comparaison
empty($var) // renvoie vrai si $var n'est pas définie, est vide ou vaut 0
isset($var) // renvoie vrai si $var n'est pas définie quelle que soit sa valeur

// Suppression d'un fichier
unlink('fichier.txt');
// Suppression d'une variable
unset($var);
// Suppression d'une session
session_destroy();

// Nombre aléatoire
srand(); // initialisation du générateur de nombres aléatoires
$nb = rand(1,10);

// Redirection
header('location:url');
exit() // On fait suivre par exit() qui stoppe le script php
// /!\ ne fonctionne que si je n'ai eu AUCUNE instruction 'echo' avant ni balise HTML


// Encryptage

md5($password); // encrypte en md5 (32 caractères)
sha1($password); // encrypte SHA1 Secure Hash Algorithm 1


