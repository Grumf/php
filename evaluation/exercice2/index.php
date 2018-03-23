<!-- Créer une fonction permettant de convertir un montant en euros vers un montant en dollars
américains.
Cette fonction prendra deux paramètres :
● Le montant de type int ou float
● La devise de sortie (uniquement EUR ou USD).
Si le second paramètre est “USD”, le résultat de la fonction sera, par exemple :
1 euro = 1.085965 dollars américains
Il faut effectuer les vérifications nécessaires afin de valider les paramètres. -->

<?php

function conversion( $eur, $usd = 1.085965 ){

    echo "<p>".$eur." euro = ".($eur*$usd)." dollards américain</p>";
}

echo conversion(20.10);
