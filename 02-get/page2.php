<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Page 2</h1>
    <pre>
        <?php

if ($_GET && isset($_GET['article'])){
        echo $_GET['couleur'];}

        /* $_GET est une super globales qui récupère  les informations provenant de l'url et créé un tableau associatif

        ex : ?article=jean&couleur=bleu
        $_GET['article'] vaut jeans
        $_GET['couleur'] vaut bleu

        /!\ Pas de données sensibles via $ _GET (pas de password,...)

        ex: fiche_produit.php?id_produit=657
        
        */

        ?>
    </pre>
</body>
</html>