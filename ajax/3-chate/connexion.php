<?php

require_once('inc/init.php');


//ici l'adresse IP est à considérer comme si que c'est notre mdp
if( isset($_POST['connexion']) )    //si le formulaire est envoyé
{
    if(!empty($_POST['pseudo'])){ //si le pseudo n'est pas vide
        $result=$pdo->prepare("SELECT * FROM membre WHERE pseudo=:pseudo");
        $result->execute(array(
            'pseudo' => $_POST['pseudo'],
        ));
    
        $membre=$result->fetch(PDO::FETCH_ASSOC);   // si pas de rep a mon select, mon ARRAY sera vide
        // 1 elle existe pas
        // 2 elle existe et on la connecte
        // 3 pseudo connu mais pas d'adresse IP
        // 4 pseudo occupé par quelqu'un    
        if( $result->rowcount()==0)
        {
            //l'user n'existe pas dans la base : insertion
            $insert= $pdo->prepare("INSERT INTO membre VALUES (NULL,:pseudo,:civilite,:ville,:date_naiss,:ip, ".time().")");
            $insert->execute(array(
                'pseudo' => $_POST['pseudo'],
                'civilite' => $_POST['sexe'],
                'ville' => $_POST['ville'],
                'date_naiss' => $_POST['date_naiss'],
                'ip' => $_SERVER['REMOTE_ADDR'],
            ));
            $id_membre=$pdo->lastInsertId();
        }
        elseif($result->rowcount()>0 && $membre['ip']==$_SERVER['REMOTE_ADDR'])
        {
            //le pseudo est connu et il a la meme adresse IP
            //Mise a jour de sa derniere date d'activité(esque je le connecte? estceque j'envoie un msg?...)
            $update=$pdo->prepare("UPDATE membre SET date_connection=".time()." WHERE id_membre=:id_membre");
            $update->execute(array(
            "id_membre"=>$membre['id_membre']
            ));
            $id_membre=$membre['id_membre'];    //je renseigne id-membre avec ce qui vient de la bdd. Car on a besoin plus bas de $id_membre
        }
        else
        {
            //Le pseudo est déjà reservé par quelqu'un. l'user doit changer ce pseudo
            $msg .='<div class="erreur">Ce pseudo est déjà réservé</div>';
        }

        if(empty($msg))
        {
            $_SESSION['id_membre']=$id_membre;
            $_SESSION['pseudo']=$_POST['pseudo'];
            header('location:index.php'); //redirection vers la page d'entrée  :// ATTENTION! cette fonction HEADER ne marche que si je n'ai AUCUN ECHO plus haut, dans la page.
        }
    }
    else
    {
        //Le champ pseudo est retourné vide
        $msg .='<div class="erreur">Merci de renseigner votre PSEUDO</div>';        
    }
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Chate</title>
    
    <link rel="stylesheet" href="inc/style.css">

</head>
<body>
<?=$msg?>   <!--c'est là que s'affiche le message d'erreur : PSEUDO DEJA RESERVE-->
    <form method="post" action="">
    <fieldset>

        <label for="pseudo">Pseudo
            <input type="text" id="pseudo" name="pseudo">
        </label>
        <p>Laissez les champs suivants vides si vous êtes déja membre</p>

        <label for="ville">Ville
            <input type="text" id="ville" name="ville">
        </label><br>

        <label for="date_naiss">Date de naissance
            <input type="text" id="date_naiss" name="date_naiss">
        </label><br>

        <label for="sexe">Sexe:
            <input type="radio" name="sexe" value="m" checked>un homme<br>
            <input type="radio" name="sexe" value="f">une femme<br>
        </label><br>      
        
        <input type="submit" name="connexion" value="se connecter au Chate">
    </fieldset>
    </form>   
</body>
</html>
