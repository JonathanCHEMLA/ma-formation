<?php

require_once("init.php");
extract($_POST);

// 3. je traite l'appel venant du fichier JS
// on recupere dans le POST  id=[numéro choisi dans la selection] 

$result = $pdo->prepare("DELETE FROM employes WHERE id_employes=:id_employes");
$result->execute( array(
    ':id_employes' => $id
));

// On remplace notre 
// Création d'un tableau avec un index 'liste_a_jour' qui va contenir l'intégralité de ma balise <select>
// $tab = array();
$tab['liste_a_jour']='<select name="personne" id="personne">';

$result= $pdo->query("SELECT * FROM employes");
while( $employe= $result->fetch(PDO::FETCH_ASSOC)){
	$tab['liste_a_jour'] .='<option value="'.$employe['id_employes'].'">'.$employe['prenom'].'</option>';
}

$tab['liste_a_jour'] .='</select>';

// 4. J'envoie à js mon tableau au format JSON car js ne peut pas lire les tableau PHP. Mais ce JSON sera encodé, c-a-d qu'on aura indice=valeur&indice=valeur&...

//ce echo est visible dans notre network
echo json_encode($tab); //transforme notre tableau en format JSON. Bref le tableau sera "parsé en JSON"

?>