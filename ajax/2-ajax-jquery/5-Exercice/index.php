<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form method="POST" action="#" id="myform">
        <input type="hidden" name="action" id="action" value="insertion">
    <fieldset>  <!--c est pour mettre un cadre-->
    <legend>INSERER UN EMPLOYE</legend>
    <label for="prenom">Prénom: <input type="text" name="prenom" id="prenom"></label>
    <label for="nom">Nom: <input type="text" name="nom" id="nom"></label>
    <label for="sexe">Sexe:   <select name="sexe" id="sexe">
            <option value="m">Homme</option>
            <option value="f">Femme</option>
            </select></label>
    <label for="service">Service: <input type="text" name="service" id="service"></label>
    <label for="date_embauche">Date_embauche: <input type="text" name="date_emb" id="date_emb" placeholder="AAAA-MM-JJ"></label>
    <label for="salaire">Salaire: <input type="text" name="salaire" id="salaire"></label>
    
    <input type="submit" name="submit" value="enregistrer" id="submit"> <!-- ATTENTION   PHP recherche par NAME, et JS recherche par ID(getElementById)-->

    </fieldset>
	</form>

    <div id="employes"></div>
    <!--EXERCICE : Afficher un tableau avec tous les employes dans une <DIV> -->   
    <!--Sur chaque ligne prévoir une actino de suppression s'executant en AJAX -->

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <!-- Attention: important que notre fichier js(ajax.js) soit bien chargé APRES jquery -->
    <script src="ajax.js"></script>
</body>
</html>