<?php

session_start();

echo 'Temps actuel :'. time() .'<br>';

print_r($_SESSION); // print_r() permet d'afficher le contenu d'une variable de type array

if ( isset($_SESSION['temps']) ) // Si l'entrée temps existe dans $_SESSION
{
    if ( time() > ( $_SESSION['limite']+ $_SESSION['temps']) )
    {
        session_destroy(); // si c'est le cas, la page n'a pas été rafraichie dans les 10 secondes
        echo "expiration de la session";
    }
    else
    {
        $_SESSION['temps'] = time();
        echo 'Connexion mise à jour : 10 secondes de plus !';
    }
}
else
{
    echo "Connexion";
    $_SESSION['limite'] = 10; // Je fixe le temps d'inactivité (sec)
    $_SESSION['temps'] = time();
    $_SESSION['login'] = 'Grumf';
    $_SESSION['mdp'] = 'secret';
}

/* 
Les informations d'une session sont enregistrées côté serveur, cela créé dans le même temps un COOKIE qui identifie la session :
    PHPSESSID
sur le pc et le navigateur du client.

Si l'internaute supprime ses cookies il casse le lien entre l'id de session et les infos stockées sur le serveur

En général sur les sites qui vous proposent une connection, il y a une session qui vous "garde" connecté à partir du moment où vous êtes passés une fois par la porte d'entrée. (Vous êtes identifié)

Avantages : vos infos de session sont conservées d'une page à l'autre du site(ex: on conserve son panier)

    */