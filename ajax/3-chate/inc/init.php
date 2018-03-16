<?php 
$pdo=new PDO('mysql:host=localhost;dbname=chate',
'root','',array( PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
PDO::MYSQL_ATTR_INIT_COMMAND =>'SET NAMES utf8'));

session_start();

$msg='';

// AAAA-MM-JJ
function age( $naiss )
{
    //j'explose la date de naissance en 3 variables et je stocke l'année dans $l_annee, le mois dans $le_mois et le jour dans $_le_jour
    list($l_annee, $le_mois, $le_jour)= explode( '-',$naiss );
    if($diff= ( date('m') - $le_mois ) < 0 )
    {
        //ce n'est pas encore son anniversaire, depuis le début de l'année. la variable annee=son annee de naissance +1. (le calcul se fait en condirant qu elle est ne en 1985)
        $l_annee++;
    }
    elseif($le_mois == 0 && date('d')- $le_jour < 0)
    {
        $l_annee++;
    }
    return date('Y') - $l_annee;
}