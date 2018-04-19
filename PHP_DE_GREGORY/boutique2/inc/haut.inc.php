<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Ma boutique de DINGUE!!</title>

    <!-- Bootstrap -->
    <link href="inc/css/bootstrap.min.css" rel="stylesheet">
    <link href="inc/css/style.css" rel="stylesheet">
	<link rel="icon" type="image/png" href="/PHP_DE_GREGORY/boutique2/inc/img/logo2.png" />
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="inc/js/bootstrap.min.js"></script>
  </head>
  <body>
  
	<nav class="navbar navbar-inverse ma-nav">
      <div class="container ma-nav">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
		  <a href="#"><img src="inc/img/logo2.png" width="60" height="53" style="padding: 5px;"></a>
          <!--<a class="navbar-brand" href="#">Ma Boutique</a>-->
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
			<?php
			if(internauteEstConnecteEtEstAdmin())
			{//BackOffice
				echo '<li><a href="' . URL . 'admin/gestion_membre.php">Gestion des membres</a></li>';
				
				echo '<li><a href="' . URL . 'admin/gestion_commande.php">Gestion des commandes</a></li>';
				
				echo '<li><a href="' . URL . 'admin/gestion_boutique.php">Gestion de la boutique</a></li>';
			}
			if(internauteEstConnecte())
			{ // accès membre
				echo '<li><a href="' . URL . 'profil.php">Voir votre profil</a></li>';
				
				echo '<li><a href="' . URL . 'boutique.php">Accès à la boutique</a></li>';
				
				if(isset($_SESSION['panier']))
				{
					echo '<li><a href="' . URL . 'panier.php">Mon Panier   <span class="badge" style="background: red;">'. array_sum($_SESSION['panier']['quantite']) .'</span></a></li>';
				}
				else
				{
					echo '<li><a href="' . URL . 'panier.php">Mon Panier</a></li>';
				}
				
				echo '<li><a href="' . URL . 'connexion.php?action=deconnexion">Deconnexion</a></li>';
			}
			else // visiteur
			{
				echo '<li><a href="' . URL . 'inscription.php">Inscription</a></li>';
				
				echo '<li><a href="' . URL . 'connexion.php">Connexion</a></li>';
				
				echo '<li><a href="' . URL . 'boutique.php">Accès à la boutique</a></li>';
				
				if(isset($_SESSION['panier']))
				{
					echo '<li><a href="' . URL . 'panier.php">Mon Panier   <span class="badge" style="background: red;">'. array_sum($_SESSION['panier']['quantite']) .'</span></a></li>';
				}
				else
				{
					echo '<li><a href="' . URL . 'panier.php">Mon Panier</a></li>';
				}
			}
			?>
            
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav> 
	
	
	<div class="container mon-conteneur">