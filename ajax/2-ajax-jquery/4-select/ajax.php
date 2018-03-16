<?php

require_once("init.php");
extract($_POST);

// 3. je traite l'appel venant du fichier JS
// on recupere dans le POST $id  
//pour info: id=[numéro choisi dans la selection] 

$result = $pdo->prepare("SELECT * FROM employes WHERE id_employes=:id_employes");
$result->execute( array(
    'id_employes' => $id
));

// On remplace notre 
// Création d'un tableau avec un index 'liste_a_jour' qui va contenir l'intégralité de ma balise <select>
// $tab = array();


if( $employe = $result->fetch(PDO::FETCH_ASSOC))
{
    $tab['validation']='ok';
    $tab['resultat']='<table border="1"><tr>';

    // on parcourt chaque entete de ma seule ligne de resultat: Prenom, nom, salaire...
    for ( $i=0 ; $i<$result->columnCount() ; $i++ )
    {
        $infos_colonne=$result->getColumnMeta($i);
        $tab['resultat'] .='<th>'. $infos_colonne['name'] .'</th>';
    }
    $tab['resultat'] .='</tr><tr>';

    // on parcourt chaque champ de ma seule ligne de resultat: Jean-Pierre, Laborde, 5000...
    for ( $i=0 ; $i<$result->columnCount() ; $i++ )
    {
        $infos_colonne=$result->getColumnMeta($i);
        $nom_colonne= $infos_colonne['name'];
        //a chaque tour, je recupere la valeur stockée dans la colonne pour l'employe choisi
        $tab['resultat'] .='<td>'. $employe[$nom_colonne] .'</td>';
    }


}
else
{
    $tab['validation']='non ok';
}


// 4. J'envoie à js mon tableau au format JSON car js ne peut pas lire les tableau PHP. Mais ce JSON sera encodé, c-a-d qu'on aura indice=valeur&indice=valeur&...

//ce echo est visible dans notre network
echo json_encode($tab); //transforme notre tableau en format JSON. Bref le tableau sera "parsé en JSON"

?>