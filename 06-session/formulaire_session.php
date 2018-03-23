<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<?php

/*
EXERCICE : Créer un formulaire pour demander le pseudo à l'internaute.
Quand il valide son pseudo, on garde l'information en session.
Quand il revient sur la page, on lui affiche 'votre pseudo es t<pseudo> et on n'affiche plus le formulaire.
Ne pas enregistrer d'information si le pseudo est vide.
*/
session_start();

if ( $_POST && !empty($_POST['pseudo']) )
{
    $_SESSION['pseudo'] = $_POST['pseudo'];
}
if ( isset($_SESSION['pseudo']) )
{
    echo "Votre pseudo est ".$_SESSION['pseudo']." !";
}
else {
    ?>
    <form method="post" action="">
        <label for="pseudo">Pseudo</label>
            <input type="text" id="pseudo" name="pseudo">
            <input type="submit" value="envoi">
    </form>
<?php
}


 ?>
</body>
</html>

