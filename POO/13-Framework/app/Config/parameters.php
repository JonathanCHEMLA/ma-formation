<?php

$parameters= array(
	'connect' => array(
				'host'		=>'localhost',
				'dbname'	=>'boutique',
				'login' 	=>'root',
				'password'	=>''
	),
	'site' => array(
				'url'		=> 'http://localhost/formateur/ma-formation/POO/13-Framework/web/',
				'racine'	=> ''
	)
);

//-----

//on testera à chaque fois nos fichiers pour veruiifier qu il n y a pas d erreeur, puis on les met en commentaires:
//----------------
// echo '<pre>';
// print_r($parameters);
// echo '</pre>';



//on a créé un tab multidim car on pourrait avoir d'autres parametres, comme par ex, les info de securité