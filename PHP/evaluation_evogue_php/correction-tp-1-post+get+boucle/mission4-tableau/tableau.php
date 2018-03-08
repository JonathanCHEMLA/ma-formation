<?php
$tab = array("tableau" => array(0 => "julien", 1 => "nicolas", 2 => "mathieu", 3 => "christelle", 4 => "nina", 5 => "johanna"));

print "<pre>";print_r($tab);print "<pre>";
echo $tab["tableau"][2];

$prenom = $tab["tableau"][2];
	$f = fopen("prenom.txt","a");
		fwrite($f, $prenom . " - ");
	$f = fclose($f);
?>