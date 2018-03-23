<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>

<?php

// PDO : Php Data Object

echo "<h1>01 - PDO: Connexion</h1>";

$pdo = new PDO('mysql:host=localhost;dbname=entreprise',
                'root', // 
                '', // Mot de passe (ici rien)
                array(
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
                    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
                ));

echo '<h2>02 - PDO: Insert, Update, Delete</h2>';

/* $pdo->exec("INSERT INTO employes VALUES (NULL, 'test', 'test','m','gigolo','2018-01-22',500)");
echo "dernier id ajouté :" . $pdo->lastInsertId();
$dernier_id = $pdo->lastInsertId();

$pdo->exec("UPDATE employes SET salaire=1400 WHERE id_employes=".$dernier_id); */

$resul = $pdo->exec("DELETE FROM employes WHERE id_employes=997");

// $pdo->exec execute une requête directe (insert, update, delete)
// Si je stocke l'execution dans une variable (ex: resul), il contienra le nombre de lignes affectées par la requête

echo "<h2>03 - PDO: Select</h2>";

$resul=$pdo->query("SELECT * FROM employes WHERE prenom='daniel'");

echo '<pre>';
var_dump($resul);
var_dump( get_class_methods($resul) );
echo '</pre>';

$employe_daniel = $resul->fetch(PDO::FETCH_ASSOC);

// var_dump($employe_daniel);

echo "Bonjour, je suis ".$employe_daniel['prenom'].' '. $employe_daniel['nom']." du service ".$employe_daniel['service'].".<br>";

/* 
$pdo est un objet(1) issu de la classe prédéfinie PDO
Quand on execute une requête de selection via la méthode query() sur l'objet PDO, on obtient un autre objet(2) issu de la classe PDOStatement qui a ses propres propriété et méthodes.

Si on execute une requête de type insert, update , delete avec query() au lieu de exec(), on obtient un booléen.
*/

echo "<hr>";

// select avec plusieurs résultats
$resul = $pdo->query("SELECT * FROM employes WHERE service='commercial'");

echo 'Nombre de commerciaux : '.$resul->rowCount().'<br>';

while( $contenu = $resul->fetch(PDO::FETCH_ASSOC) ) // fetch agis comme un curseur
{
    echo $contenu['prenom'].' '.$contenu['nom'].' ('.$contenu['sexe'].')<br>';
}

// select tableau multidimensionnel
$resul = $pdo->query("SELECT * FROM employes WHERE service='commercial'");

$donnees = $resul->fetchAll(PDO::FETCH_ASSOC);
echo '<pre>';
// var_dump($donnees); ===> Affiche toute les données des commerciaux dans un tableau multidimentionnel
echo '</pre>';

foreach($donnees as $indices1 => $contenu1){

    echo "<div class='madiv'>";
    foreach($contenu1 as $indice2 => $contenu2){
        echo "$indice2 : $contenu2<br>";
    }
    echo '</div>';
}

// exercice :

$tameyr = $pdo->query("SHOW DATABASES");

var_dump($tameyr);

echo '<ul>';
while ( $base = $tameyr->fetch(PDO::FETCH_ASSOC) ){
    echo '<li>'.$base['Database'].'</li>';
}
echo '</ul>';

// Bonus

$tameyr = $pdo->query("SHOW DATABASES");


echo '<ul>';
while ( $base = $tameyr->fetch(PDO::FETCH_ASSOC) ){

    $database = $base['Database'];
    echo '<li>'.$database.'<ul>';
        $pdo->exec("USE ".$database);
        $tameyr2 = $pdo->query("SHOW TABLES");
        while ( $table = $tameyr2->fetch(PDO::FETCH_ASSOC) )
        {
            // ex : Table_In_Bibliotheque
            echo '<li>'.$table['Tables_in_'.$database].'</li>';
        }
    echo '</ul></li>';
}
echo '</ul>';

// Parcours de table

$pdo->exec('USE bibliotheque');

$nomtable = "livre";

$resul = $pdo->query("SELECT * FROM ".$nomtable);

echo "<table><tr>";

$nbcolonnes = $resul->columnCount(); // columnCount() renvoie le nombre de colonnes
for( $i=0; $i < $nbcolonnes; $i++){
    $infocolonne = $resul->getColumnMeta($i); // Envoie les information d'une colonne comme son type, son nom, sa longueur.
    echo '<th>'.$infocolonne['name'].'</th>'; // <== Ici, c'est le nom qui nous intéresse
}
echo '</tr>';

// Parcours des enregistrements

while ( $ligne = $resul->fetch(PDO::FETCH_ASSOC) )
{
    echo "<tr>";
        foreach ( $ligne as $information ){
            echo "<td>$information</td>";
        }
    echo "</tr>";
}

echo "</table>";


echo "<h2>PDO : prepare, bindParam, bindValue, execute</h2>";

$pdo->exec('USE entreprise');
$nom = 'sennard';

$resul = $pdo->prepare("SELECT * FROM employes WHERE nom = :nom");
$resul->bindParam(':nom',$nom,PDO::PARAM_STR); // bindParam reçoit exclusivement une variable
$resul->execute();
$donnees = $resul->fetch(PDO::FETCH_ASSOC);
echo implode(' ',$donnees);

echo '<hr>';

$resul = $pdo->prepare("SELECT * FROM employes WHERE nom = :nom");
$resul->bindValue(':nom','thoyer'/*$nom*/,PDO::PARAM_STR); // bindParam reçoit une variable ou une chaîne de caractère
$resul->execute();
$donnees = $resul->fetch(PDO::FETCH_ASSOC);
echo implode(' ',$donnees);

    ?>
</body>
</html>
