<?php
require_once("inc/init.inc.php");

//Selection de tous les films
$resultat=$pdo->query("SELECT * FROM movies");
$content .= '<div class="col-md-8 col-md-offset-2 text-center"><h3 class="alert-success">Affichage de tous les films</h3>';

$content .='Nombre de film(s) dans la base : <span class="">' . $resultat->rowCount() . '</span></div>';

$content .='<table class="col-md-8 table" style="margin-top: 10px;"><tr>';

	for($i=0; $i<$resultat->columnCount(); $i++)	
	{
		$colonne= $resultat->getColumnMeta($i);	
		if($colonne['name']=="title" || $colonne['name']=="director" || $colonne['name']=="year_of_prod")
		{
			$content .='<th>' . $colonne['name'] . '</th>';
		}
	}
	$content .='<th>' . 'Plus d\'infos' . '</th>';
$content .='</tr>';

$ligne = $resultat->fetch(PDO::FETCH_ASSOC);


// Affichage des titre,directeur et année de production
while($ligne = $resultat->fetch(PDO::FETCH_ASSOC))
{
	$content .= '<tr>';
	$content .= '<td>' . $ligne['title'] . '</td>';	
	$content .= '<td>' . $ligne['director']. '</td>';		
	$content .= '<td>' . $ligne['year_of_prod'] . '</td>';
	$content .= '<td>' . '<a href="detail.php?id_movie=' . $ligne['id_movie'] . '"><strong>+</strong></a>' . '</td>';
	$content .= '</tr>';
}
$content .= '</table>';


	
require_once("inc/header.inc.php");
echo $content;	

require_once("inc/footer.inc.php");
?>	
	
