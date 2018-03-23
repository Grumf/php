<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Contact</title>
</head>
<body>

<form action="" method="post">
    <label for="nom">Nom</label>
    <input type="text" id="nom" name="nom"><br>
    <label for="exp">Email</label>
    <input name="expediteur" id="exp" type="email"><br>
    <label for="message">Message</label>
    <textarea name="mes" id="message" cols="30" rows="10"></textarea><br>
    <input type="submit" value="envoi">
</form>
    
</body>
</html>

<?php

$expediteur = 'From: '.$adressemaildestinataire;

mail($destinataire, $sujet, $message, $expediteur)

if ($_POST){

    $expediteur
}

?>