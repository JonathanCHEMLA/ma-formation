<?php
//ce fichier et ajax.js ne s'executerons que si on est nous meme l'admin du tchat. Pour le monet c'est celui de fred
?>
<?php
// lorsqu'on teste le var_dump,si c'est pas dans le corps de notre page html, 
//ce n'est pas la peine de l'entourer des balises echo "<pre>";
//var_dump($_POST);

require_once("init.php");

// EXTRACT transforme les indexs du tableau en variable PHP
extract($_POST);
// 1: on envoi les parametres au format json ou au format type GET
// 2: PHP les recoit dans un tableau: POST
// 3: on extrait les index pour en faire des variables

/*
*Exemple: $_POST(
    'action' => 'affichage_message',
    'lastid'=>2
)
extract-> $action,$lastid
*/


//ma variable de retour:
$tab=array();

if($action=='affichage_message'){
    $lastid=(integer)($lastid);// dans le cas ou je recupere un lastid qui n'est pas un entier, je le force a etre un integer
    $result=$pdo->prepare("SELECT d.id_dialogue,m.pseudo,m.civilite,d.message,date_format(d.date,'%d/%m/%Y - %H:%i:%s') as datefr FROM dialogue d,membre m WHERE d.id_dialogue >:lastid AND d.id_membre=m.id_membre ORDER BY d.date ASC");
    //on souhaite les nouveaux messages a partir du dernier id connu
    if ($result->execute(array( // si un internaute a envoye un nouveau msg
        'lastid' => $lastid
        )))
        {

        $tab['validation']='ok';
            
        $tab['resultat']='';
        $tab['lastid']=$lastid;
        while($message=$result->fetch(PDO::FETCH_ASSOC))
        {
            if($message['civilite']=='m'){$color="bleu";}
            if($message['civilite']=='f'){$color="rose";}
            $tab['resultat'] .='<p class"' .$color.'">' .$message['datefr'].'<strong>'. $message['pseudo'].'</strong>&#9658;'.$message['message'].'</p>';

            //lastid prend la valeur du dernier id inséré
            $tab['lastid']=$message['id_dialogue'];

        }
    }
}

if($action=='affichage_membre_connecte'){
    //"date_connexion", dans la bdd, est un timestamp
    //cette function est executee toutes les 8 secondes(voir ajax.js)
    $result=$pdo->query("SELECT * FROM membre WHERE date_connexion > ". (time() - 3600) . " ORDER BY pseudo");
    $tab['resultat']='<h2>Membres connectés</h2>';
    if($result->rowcount()>0)
    {
        $tab['validation']='ok';    //condition a remplir pour effectuer la mise à jour de la partie droite (liste des membres)

    }
    //Je liste les membres ayant eu une activité dan sla dernière heure(3600 secondes)
    while ( $membre = $result->fetch(PDO::FETCH_ASSOC) )
    {
        if($membre['civilite']=='m'){$color="bleu";$civ="Homme";}
        if($membre['civilite']=='f'){$color="rose";$civ="Femme";}
        
        $tab['resultat'].='<p class="'.$color.'" title="'.$civ.','.$membre['ville'].','.age($membre['date_de_naissance']).' ans">'.ucfirst($membre['pseudo']).'</p>';
 
    }
}

if($action=='envoi_message'){
    // on supprime les eventuelles balises html mais on conserve les quotes/apostrophes/guillemets s'il y en a   
    // je convertis les balises en texte ex: (le texte "<strong>" s'affichera au lieu de mettre le contenu en strong)
    $message=htmlspecialchars($message,ENT_QUOTES);
    if(!empty($message)){
        //insertion du message
        $result=$pdo->prepare("INSERT INTO dialogue (id_membre,message,date) VALUES (:id_membre,:message, now())");
        if($result->execute(array(
            'id_membre'=>$_SESSION['id_membre'],
            'message'=>$message,
        ))){
            $tab['validation']='ok';
        }
        //on va actualiser la derniere date d'activité du membre qui vient d'écrire
        $result=$pdo->prepare("UPDATE membre SET date_connexion=:date_connexion WHERE id_membre=:id_membre");
        $result->execute(array(
            'date_connexion'=>time(),
            'id_membre'=> $_SESSION['id_membre']
            // chaque fois qu'il ecrit un message, on reactualise sa date de connection. Finalement c'est plutot une "date d'actualisation" qu'une "date de connexion"
        ));
    }


}

if($action=='deconnecter'){
    session_destroy();
    $tab['validation']="ok";
}

echo json_encode($tab);