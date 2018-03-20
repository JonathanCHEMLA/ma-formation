<?php

//index.php?page=connexion
//require connexion.php

require_once('connexion_bdd.php');


if(isset($_GET['page']) && !empty($_GET['page']) ){
	
	require $_GET['page'] . '.php';
	
}

