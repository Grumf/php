<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href=".\assets\css\bootstrap.min.css">
    <link rel="stylesheet" href=".\assets\css\styles.css">
    <title>SuperFilms</title>
</head>
<body>

<?php

// Appel de la bdd
$db = new PDO('mysql:host=localhost;dbname=exercice_3',
                'root',
                '',
                array(
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
                    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
                ));

$films = $db->query("SELECT * FROM movies");

// Definition des variables
$contenu="";
$nbcolonnes = $films->columnCount();


// Création du tableau
$contenu.="<table>
                <tr>";

// En-tête
for( $i=0; $i<$nbcolonnes; $i++){

    $colonne = $films->getColumnMeta($i);
    $contenu.='<th>'.ucfirst($colonne['name']).'</th>';
    }

    $contenu.='<th colspan="2"> </th>
                <tr>';

    // Contenu
    while ( $film = $films->fetch(PDO::FETCH_ASSOC) ){
        foreach( $film as $indice => $information ){
                $contenu.="<td class='text-center'>".$information."</td>";
        }
        $contenu.="<td><a href='fiche_film.php?id_movies=".$film['id_movies']."'>Lire plus</a></td>";
        $contenu.="</tr>";
}
$contenu.="</tr></table>";


echo $contenu;

?>

<!-- JS et BOOTSTRAP -->
<script src="./assets\js\jquery-3.3.1.min.js"></script>
<script src="./assets/js/bootstrap.min.js"></script>
</body>
</html>