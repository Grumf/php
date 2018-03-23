<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Fjalla+One|Rubik:300" rel="stylesheet">
    <title>Dialogue</title>
</head>
<body>
    <?php
    /* Espace de dialogue

    01.[x] Modélisation et création (base dialogue/base commentaire)
    02.[x] Connexion à la base
    03.[x] Créer un formulaire HTML pour l'ajout d'un message (pseudo/message)
    04.[x] Récuperation et affichage des messages déjà saisis
    05.[x] Requête d'enregistrement (INSERT)
    06.[x] Confirmation à l'internaute (via $_POST)
    07.[x] Attaque : injection SQL
    08.[x] Etudes et moyens pour contrer les attaques
    09.[x] Ordonner et mettre les derniers messages en tête de liste
    10.[ ] Afficher le nombre de messages
    11.[ ] Améliorer le visuel (css) 
    12.[ ] Tests
    */

    $db = new PDO('mysql:host=localhost;dbname=dialogue',
                'root',
                '',
                array(
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
                    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
                ));

    if ($_POST){


        if ( !empty($_POST['pseudo']) && !empty($_POST['message'])) {

            $_POST['message'] = addslashes($_POST['message']); // Permet l'ajout de caractères spéciaux

            // $_POST['message'] = strip_tags($_POST['message']); // Supprime les balises html

            $_POST['message'] = htmlspecialchars($_POST['message']); // htmlspecialchars() rend innofensive les balises html

        $sql = "INSERT INTO commentaire VALUES (NULL, '$_POST[pseudo]','$_POST[message]',NOW())";

        if ($db->query($sql)){
            echo '<p class="reg"><h2>Message enregistré</h2></p>';
        }
    }
}

    ?>
    <div class="container">
    <form action="" method="post">
        <fieldset>
            <legend><h2>Formulaire</h2></legend>
            <label for="pseudo">Pseudo</label>
            <input type="text" id="pseudo" name="pseudo" value="<?= $_POST['pseudo'] ?? ''?>">
                <br>
            <label for="message">Message</label><br>
            <textarea name="message" id="message" cols="30" rows="10"></textarea>
                <br>
            <input type="submit" value="envoyer" class="button">
        </fieldset>
    </form>
    <?php
    
    $resul = $db->query("SELECT *, DATE_FORMAT(date_enregistrement, '%d/%m/%Y') AS datefr, DATE_FORMAT(date_enregistrement, '%H:%i:%s') AS heurefr FROM commentaire ORDER BY date_enregistrement DESC");
    echo "<main><fieldset><legend><h2>Messages</h2></legend>";
    while ($commentaire = $resul->fetch(PDO::FETCH_ASSOC)){
        echo "<div class='message'>
            <div class='titre'>Par : ".$commentaire['pseudo'].", le ".$commentaire['datefr'].' à '.$commentaire['heurefr']."</div>
            <div class='contenu'>".$commentaire['message']."</div></div>";
    }
    echo '</fieldset></main><div class="clear"></div>';

    ?>
    </div>
</body>
</html>