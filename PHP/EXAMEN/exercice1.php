<?php

//Création du tableau

$tableau = array(
		0=> array("prenom" => "Jonathan","nom"=>"CHEMLA","adresse"=>"1 rue de Paris","code_postal"=>"93500","ville"=>"PANTIN","email"=>"monmail@monmail.com","telephone"=>"0765321445","date_de_naissance"=>"2010-08-22"),
		1=> array("prenom" => "Marcel","nom"=>"CHEMLA","adresse"=>"2 rue de la providence","code_postal"=>"93260","ville"=>"LES LILAS","email"=>"monmail2@monmail2.com","telephone"=>"0745522445","date_de_naissance"=>"2006-05-02"),
		2 =>array("prenom" => "Hubert","nom"=>"CHEKLY","adresse"=>"1 Av de la république","code_postal"=>"75009","ville"=>"PARIS","email"=>"monmail3@monmail3.com","telephone"=>"0123456789","date_de_naissance"=>"2000-01-22"),
		3=>array("prenom" => "Robert","nom"=>"UZAN","adresse"=>"13 Allee des fleurs","code_postal"=>"75008","ville"=>"PARIS","email"=>"monmail4@monmail4.com","telephone"=>"0789123456","date_de_naissance"=>"2002-08-20"),
			);

			
//Affichage du contenu de ce tableau dans une liste

echo '<ul>';
foreach($tableau as $indice1=>$valeur1)
{
	foreach($valeur1 as $indice2=>$valeur2)
	{
		echo "<li>";
			if($indice2=="date_de_naissance")
			{
				// Affichage de la date au format francais via DATETIME:
				$date = new DateTime($valeur2);
				echo $date ->format('d/m/Y');
				}
			else
				//Affichage de toutes les informations, autres que la date de naissance.
			{
				echo $valeur2;
			}
			
		echo "</li>";
	}

}
echo '</ul>';			

?>