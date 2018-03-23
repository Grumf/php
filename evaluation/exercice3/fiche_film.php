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

$films = $db->query("SELECT * FROM movies WHERE id_movies=".$_GET['id_movies']);

echo "<a href='tableau.php'>Voir les films</a>";

while ( $film = $films->fetch(PDO::FETCH_ASSOC) ){

echo "<h1>".$film['title']."</h1><hr>
        <h3>Réalisateur : ".$film['director']."</h3>
        <h3>Producteur : ".$film['producer']."</h3>
        <h4>Acteurs principaux : ".$film['actors']."</h4>
        <h4>Produit en ".$film['year_of_prod']."</h4>
        <h4>".$film['category']."</h4>
        <h4>Bande annonce : <a href='".$film['video']."'>ici !</a></h4>
        <h4>Langue : ".$film['language']."</h4>
        <p>Synopsis : ".$film['storyline']."</p>";

        }

?>

    <!-- JS et BOOTSTRAP -->
    <script src="./assets\js\jquery-3.3.1.min.js"></script>
    <script src="./assets/js/bootstrap.min.js"></script>
</body>
</html>