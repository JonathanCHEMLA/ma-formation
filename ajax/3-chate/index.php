<?php
//echo "mon IP est ".gethostbyname($_SERVER['REMOTE_HOST']);
//echo "mon IP est ".gethostbyname($_SERVER['SERVER_NAME']);


/**
 * Cette superglobale $_SERVER renvoie l'adresse IP du client(remote_addr) 
 * sur son entree REMOTE_ADDR
*/
// echo "mon IP est ".$_SERVER['REMOTE_ADDR'];

require_once('inc/init.php');
if( !isset($_SESSION['pseudo']))
{
    //si on n'a pas de pseudo en session, çà veut dire qu'on n'est pas encore passé par la page de connexion
    header('location:connexion.php');
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
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <!-- Attention: important que notre fichier js(ajax.js) soit bien chargé APRES jquery -->
    <script src="inc/ajax.js"></script>
</head>
<body>
    <div id="conteneur">
        <div id="message_tchat">
            <h2>Connecté en tant que <?=$_SESSION['pseudo']?></h2>
            <?php
                $result=$pdo->query("SELECT d.id_dialogue, m.pseudo, m.civilite,d.message, date_format(d.date,'%d%m%Y - %H:%i:%s') as datefr FROM dialogue d, membre m WHERE m.id_membre=d.id_membre ORDER BY date");
                while($dialogue = $result->fetch(PDO::FETCH_ASSOC)){
                    if($dialogue['civilite']=='m'){$color="bleu";}
                    if($dialogue['civilite']=='f'){$color="rose";}
                    ?>
                    <p class="<?$color?>"><?=$dialogue['datefr']?><strong><?= $dialogue['pseudo']?></strong>&#9658;<?=$dialogue['message']?></p>
                <?php
                }
            ?>
        </div>
        <div id="liste_membre_connecte">
            <h2>Membres connectés</h2>
            <?php
            //si on a une connectivite sur la dernier heure alors:
            $result=$pdo->query("SELECT * FROM membre WHERE date_connexion > ". (time() - 3600) . " ORDER BY pseudo");
            while ( $membre = $result->fetch(PDO::FETCH_ASSOC))
            {
                if($membre['civilite']=='m'){$color="bleu";$civ="Homme";}
                if($membre['civilite']=='f'){$color="rose";$civ="Femme";}
                ?>
                <p class="<?=$color?>" title="<?=$civ.','.$membre['ville'].','.age($membre['date_de_naissance']) ?>"><?=ucfirst($membre['pseudo'])?></p>
                <?php
            }
            ?>
        </div>
        <div class="clear">
        </div>
        <div id="smiley">
        </div>
        <div id="formulaire_chate">
            <form method="post" action="#">
                <input class="textarea" type="text" id="message" name="message" maxlengh="255"><!--un varchar etant limité à 255 caractères en BDD-->
                <input type="submit" name="envoi" value="envoi" class="submit">
            </form>
        </div>
    </div>

</body>
</html>