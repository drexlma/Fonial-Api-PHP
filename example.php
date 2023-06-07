<?php

require('fonial.class.php');


$Fonial = new Fonial();
echo '<h2>Geräte</h2>';
print_r($Fonial->deviceGet());


echo '<h2>Nummern</h2>';
print_r($Fonial->numbersGet());


echo '<h2>Einzelverbindungsnachweises</h2>';
print_r($Fonial->evnGet( date('Y-m-d h:i:s',time()-(60*60*24*5)), date('Y-m-d h:i:s')) );
