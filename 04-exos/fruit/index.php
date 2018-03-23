<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Fruit</title>
</head>
<body>

<h1>Formulaire</h1>
<form method='post' action=''>
    <select name="fruit_choisi">
        <option value='cerise'>Cerises</option>
        <option value='banane'<?= ( isset($_POST['fruit_choisi']) && $_POST['fruit_choisi']== 'banane') ? 'selected' : '' ?>>Bananes</option>
        <option value='peche'<?= ( isset($_POST['fruit_choisi']) && $_POST['fruit_choisi']== 'peche') ? 'selected' : '' ?>>Pêches</option>
        <option value='pomme'<?= ( isset($_POST['fruit_choisi']) && $_POST['fruit_choisi']== 'pomme') ? 'selected' : '' ?>>Pommes</option>
    </select>
        <br>
        <label for="poids">Quantité en Kg</label>
            <input type="text" name="poids" id="poids" value="<?= $_POST['poids'] ?? '' ?>">
            <input type='submit' value='envoie'>
</form>

<hr>
<?php

require_once('function.php');

if ($_POST){

    if ( isset($_POST['fruit_choisi']) && is_numeric($_POST['poids']) )
    {
        echo calcul( $_POST['fruit_choisi'], $_POST['poids']);
    }
    else {
        echo "Veuillez choisir un fruit et entrer un poids en chiffre(s)<br>";
    }
}

?>

    
</body>
</html>