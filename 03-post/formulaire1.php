<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Formulaire</h1>
    <pre>
        <?php var_dump($_POST);
        if ( $_POST && empty($_POST['email']) )
        {
            echo 'Rentre ton email connard.';
            
        }

        // implode, explode, extract

        $parametres = implode( '#',$_POST); // Tableau en chaîne
        var_dump($parametres);

        $date = '19/01/2018';
        $date_tableau = explode('/',$date); // Chaine en tableau
        var_dump($date_tableau);

        extract($_POST); // Créé des variables à partir du tableau POST
        echo $prenom;

        ?>
    <form method="post" action="">
        <label for="prenom">Prénom</label>
        <input id="prenom" type="text" name="prenom" placeholder="mlm" value="<?= $_POST['prenom'] ?? ''; ?>">
                                                                                <!-- isset($_POST['prenom']) ? $_POST['prenom'] : '', -->
        <label for="email">Email</label>
        <input id="email" type="text" name="email" placeholder="ton email" value="<?= $_POST['email'] ?? ''; ?>">
        <br>
        <textarea name="message" id="message" cols="40" rows="5" placeholder="Ici votre message"><?= $_POST['message'] ?? ''; ?></textarea>
        <br>
        <input type="submit" value="Envoyer le message">
    </form>
</pre>
</body>
</html>