<?php

require_once("init.php");
extract($_POST);
// 3. je traite l'appel venant du fichier JS
// on recupere dans le POST $id  
//pour info: id=[numéro choisi dans la selection] 

if($action=="affichage")
{

    $result=$pdo->query("SELECT * FROM employes ORDER BY id_employes DESC");
    $tab['resultat']='<table border="1"><tr>';

    for ( $i=0 ; $i<$result->columnCount() ; $i++ )
    {
        $infos_colonne=$result->getColumnMeta($i);
        $tab['resultat'] .='<th>'. $infos_colonne['name'] .'</th>';
    }
    $tab['resultat'] .='</tr>';    
	
    // Je boucle sur mes enregistrements 
    while( $employe = $result->fetch(PDO::FETCH_ASSOC))
    {
        $tab['resultat'] .='<tr>';
		
		foreach ($employe as $indice => $information) 
		{
			$tab['resultat'] .= '<td>' . $information . '</td>';
		}
			

		
		
        /*
		Autre methode:
			
		for ( $i=0 ; $i< $result->columnCount() ; $i++ )
        {
			
			var_dump($result->columnCount());
            $infos_colonne=$result->getColumnMeta($i);
            $nom_colonne= $infos_colonne['name'];
            //a chaque tour, je recupere la valeur stockée dans la colonne pour l'employe choisi
            $tab['resultat'] .='<td>'. $employe[$nom_colonne] .'</td>';
        }
        */
		
		$tab['resultat'] .='</tr>';
    }

      
	$tab['resultat'] .='</table>';    
}





if($action=="insertion"){
    $result=$pdo->prepare("INSERT INTO employes (nom,prenom,salaire,sexe,service,date_embauche) VALUES (:nom,:prenom,:salaire,:sexe,:service,:date_embauche)");
	if( $result->execute( array(
        ':nom' => ucfirst(strtolower($nom)),
        ':prenom'=>$prenom,
        ':salaire'=>$salaire,
        ':service'=>strtolower($service),
        ':sexe'=>$sexe,
        ':date_embauche'=>$date_emb
		))
	)
	{
		//l'insertion s'est bien passée
	    $tab['validation'] = "ok";  //ATTENTION !  lui communiquer ce qu'il attend
	}
	else
	{
		//l'insertion n'a pu avoir lieu
		$tab['validation'] = "Non ok"; 
	}
}
// 4. J'envoie à js mon tableau au format JSON car js ne peut pas lire les tableau PHP. Mais ce JSON sera encodé, c-a-d qu'on aura indice=valeur&indice=valeur&...

//ce echo est visible dans notre network
echo json_encode($tab); //transforme notre tableau en format JSON. Bref le tableau sera "parsé en JSON"

?>