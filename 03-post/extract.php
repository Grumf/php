<?php

$famille = array(
     'famille1' => 'Lannister',
     'famille2' => 'Stark',
     'famille3' => 'Targaryen'
);

var_dump($famille);
extract($famille);

echo $famille1.'<br>';
echo $famille2.'<br>';
echo $famille3.'<br>';