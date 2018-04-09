<?php
require_once("inc/init.inc.php");

if(!internauteEstConnecte())
{
	header("location:connexion.php");
}

if(isset($_GET['action']) && $_GET['action'] == 'modif_compte')
{
	$content .='<div class="col-md-8 col-md-offset-2 alert alert-success text-center">Les modifications ont bien été prise en compte!</div>';
}

$content .='<div class="col-md-8 col-md-offset-2">
	<div class="panel-default border">
		<div class="alert alert-info text-center"><h1>VOS INFORMATIONS</h1></div>
			<div class="panel-body">
				<div class="col-md-12 text-center">
					<ul class="list-unstyled">
						<h2>Bonjour <span class="text-danger">' . $_SESSION['membre']['pseudo'] . '</span></h2>
						<li><h3>Voici vos informations de profil</h3></li>
						<li>Votre nom : ' . $_SESSION['membre']['nom'] . '</li>
						<li>Votre Prénom : ' . $_SESSION['membre']['prenom'] . '</li>
						<li>Votre Email : ' . $_SESSION['membre']['email'] . '</li>
						<li>Votre code postal : ' . $_SESSION['membre']['code_postal'] . '</li>
						<li>Votre adresse : ' . $_SESSION['membre']['adresse'] . '</li>';
						if(internauteEstConnecteEtEstAdmin())
						{
							$content .= 'Vous êtes <span class="text-danger">ADMIN</span>';
						}
						else
						{
							$content .= 'Vous êtes <span class="text-danger">MEMBRE</span>';
						}
						$content.= '<hr><li><a href="modification_compte.php?action=modification&id_membre=' . $_SESSION['membre']['id_membre'] .'">Modifier votre compte</a></li>
					</ul>
				</div>
			</div>
	</div><br>	
		<div class="alert alert-info text-center"><h4>Vos commandes</h4></div>';
		$resultat = $pdo->query("SELECT * FROM commande WHERE id_membre = " . $_SESSION['membre']['id_membre']);
		
		//debug($commande_membre);	
		$content .= '<br><table class="col-md-10 table text-center" style="margin-bottom: 40px;"><tr>';
		for($i = 0; $i < $resultat->columnCount(); $i++)
		{
			$colonne = $resultat->getColumnMeta($i);
			if($colonne['name'] != 'id_membre')
			{
				$content .= '<th class="text-center">' . $colonne['name'] . '</th>';	
			}
		}
		$content .= '<th class="text-center">Détails</th>';
		$content .= '</tr>';
		while($commande_membre = $resultat->fetch(PDO::FETCH_ASSOC))
		{
			$content .= '<tr>';
			foreach($commande_membre as $indice => $information)
			{
				if($indice != 'id_membre')
				{
					if($indice == 'date_enregistrement')
					{
						$date = new DateTime($commande_membre['date_enregistrement']);
						$content .= '<td>' . $date->format('d/m/Y H:i:s') . '</td>';
					}
			
					else
					{
						if($indice == 'montant')
						{
							$content .= '<td>' . $information . ' €</td>'; 	
						}
						else
						{
							$content .= '<td>' . $information . '</td>'; 
						}
					}	
				}
			}
			$content .= '<td><a href="?action=details&id_commande=' . $commande_membre['id_commande'] . '"><span class="glyphicon glyphicon-search"></span></a></td>';
			$content .= '</tr>';
		}
		$content .= '</table><hr><hr><hr><hr><br><br><br>';
		
		if(isset($_GET['action']) && $_GET['action'] == 'details')
		{
			$resultat = $pdo->query("SELECT p.id_produit,p.titre, p.categorie, p.photo, dc.quantite, dc.prix FROM details_commande dc, produit p WHERE dc.id_produit = p.id_produit AND dc.id_commande = '$_GET[id_commande]'");	
			
			$content .='<br><br><hr><div class="alert alert-info text-center"><h4>Détail de votre commande n° ' . $_GET['id_commande'] . '</h4></div>';
			
			$content .= '<br><table class="col-md-10 table text-center" style="margin-bottom: 40px;"><tr>';
			for($i = 0; $i < $resultat->columnCount(); $i++)
			{
				$colonne = $resultat->getColumnMeta($i);
				if($colonne['name'] != 'id_produit')
				{
					$content .= '<th class="text-center">' . $colonne['name'] . '</th>';	
				}
			}
			$content .= '</tr>';
			while($detail_commande = $resultat->fetch(PDO::FETCH_ASSOC))
			{
				$content .= '<tr>';
				foreach($detail_commande as $indice => $information)
				{
					//debug($detail_commande);
					if($indice != 'id_produit')
					{
						if($indice == 'photo')
						{
							$content .= '<td><a href="fiche_produit.php?id_produit=' . $detail_commande['id_produit'] . '"><img src="' . $information . '" width="70" height="70"></a></td>';	
						}
						else
						{
							if($indice == 'titre')
							{
								$content .= '<td><a href="fiche_produit.php?id_produit=' . $detail_commande['id_produit'] . '">' . $information . '</a></td>';	
							}
							else
							{
								if($indice == 'prix')
								{
									$content .= '<td>' . $information . ' €</td>'; 	
								}
								else
								{
									$content .= '<td>' . $information . '</td>'; 
								}
							}
						}	
					}
				}

			}
			$content .= '</table><br><br><br><br>';
}
		

$content .='</div>';



require_once("inc/haut.inc.php");
//debug($_SESSION);
echo $content;
require_once("inc/bas.inc.php");
//debug($_SESSION,2);

