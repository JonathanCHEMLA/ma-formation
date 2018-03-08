<?php
/**
### Enoncé de l'exercice 1 ###

Créer un tableau en PHP contenant les infos suivantes : 
- Prénom
- Nom
- Adresse
- Code Postal
- Ville
- Email
- Téléphone
- Date de naissance au format anglais (YYYY-MM-DD)


A l’aide d’une boucle, afficher le contenu de ce tableau (clés + valeurs) dans une liste HTML.


La date sera affichée au format français (DD/MM/YYYY).
**/

$infos = [
	'firstname' => 'Jean',
	'lastname'	=> 'Dupont',
	'address'	=> '8 rue Geoffroy l\'Asnier',
	'zipcode'	=> '75004', // Note : Si le code postal est en "int", à l'affichage, les zéros initiaux seront supprimés
	'city'		=> 'Paris',
	'email'		=> 'jean.dupont@wf3.fr',
	'phone'		=> '0123456789', // Idem que pour le code postal
	'birthdate'	=> '1985-04-18',
];


?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>On se présente !</title>
</head>
<body>

	<ul><!-- Début de notre liste HTML -->
	<?php 
	// On parcours le tableau à l'aide d'une boucle foreach
	foreach($infos as $key => $value){
		// Une condition sur la clé pour la date de naissance
		if($key == 'birthdate'){
			$date = new DateTime($infos['birthdate']);
			echo '<li><strong>'.$key.' : </strong>'. $date->format('d/m/Y').'</li>';
			//echo '<li><strong>'.$key.' :</strong> '.date('d/m/Y', strtotime($value)).'</li>';
			// Avec la classe DateTime
			#echo '<li>'.$key.' : '.DateTime::createFromFormat('Y-m-d', $value)->format('d/m/Y').'</li>';
		}
		else {
			echo '<li><strong>'.$key.' :</strong> '.$value.'</li>';
		}
	}
	?>
	</ul>

</body>
</html>