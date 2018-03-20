<?php

session_start();
extract($_POST);
$tab = array();

if ($action == "debut")
{
    mt_srand(time());
    $_SESSION['devinette'] = mt_rand(1,100);
    $_SESSION['essai'] = 0;
    $tab['valid'] = 'ok';
    $tab['resultat'] = "J'ai choisi un nombre en 1 et 100";

}

if ( $action == "analyse"){

    if (is_numeric($propo))
    {
        $_SESSION['essai']++;    

        if ( $propo >  $_SESSION['devinette'] ) {  $tab['resultat'] = "<br>Mon nombre est plus petit"; }
        if ( $propo <  $_SESSION['devinette'] ) {  $tab['resultat'] = "<br>Mon nombre est plus grand"; }
        if ( $propo ==  $_SESSION['devinette'] )
        { 
            $tab['resultat'] = "<br>Bravo, vous avez trouvé <strong>".$_SESSION['devinette']."</strong> en " . $_SESSION['essai'] . " essai(s)";
            $tab['reinit'] = 'ok';
        }

        if (  $_SESSION['essai'] == 10 && !isset( $tab['reinit'] ) )
        {
            $tab['resultat'] = "<br>Vous avez atteint 10 essais. Perdu ! Mon nombre était  <strong>".$_SESSION['devinette']."</strong>";
            $tab['reinit'] = 'ok';
        }
    }
    else
    {
        $tab['resultat'] = "<br>Valeur non numérique !";
    }

    $tab['valid'] = 'ok';
}

echo json_encode($tab);