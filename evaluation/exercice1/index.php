<!-- Créer un tableau en PHP contenant les infos suivantes :
● Prénom
● Nom
● Adresse
● Code Postal
● Ville
● Email
● Téléphone
● Date de naissance au format anglais (YYYY-MM-DD)
A l’aide d’une boucle, afficher le contenu de ce tableau (clés + valeurs) dans une liste HTML.
La date sera affichée au format français (DD/MM/YYYY).
Bonus :
Gérer l’affichage de la date de naissance à l’aide de la classe DateTime -->

<?php

// construction du tableau
$presentation = array();
$presentation['prenom'] = 'chloe';
$presentation['nom'] = 'Thuillier';
$presentation['adresse'] = '79 avenue fromenteau';
$presentation['cp'] = '91600';
$presentation['ville'] = 'Savigny-sur-Orge';
$presentation['email'] = 'chloe.thuillier@gmail.com';
$presentation['tel'] = '0600660066';
$presentation['date_naissance'] = date('1990-06-25');

// redéfinition du format de la date
$date_formatee = new DateTime('1990-06-25');
$presentation['date_naissance'] = $date_formatee->format('d/m/Y');

// parcours des lignes du tableau
echo "<ul>";

    foreach($presentation as $pres => $val){
        echo "<li>".$pres." : ".$val."</li>";
    }

echo "</ul>";