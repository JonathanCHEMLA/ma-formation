<!DOCTYPE html> <!-- taper ! puis entrée -->
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>AJAX INSERT ID</title>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <!-- Attention: important que notre fichier js(ajax.js) soit bien chargé APRES jquery -->
    <script src="ajax.js"></script>
</head>
<body>
    <form method="post" action="#"> <!--On ne veut pas envoyer le form. Or, si on met rien dans action, la page est envoyée/rechargée.-->
    <!--c'est le #, combiné a preventDefault qui stoppera l'envoi du formulaire.-->
        <input type="text" name="personne" id="personne" placeholder="prénom à insérer">
        <input type="submit" value="ok" id="submit">
    </form>
    <div id="resultat"></div>
    <!-- AJAX n'est pas un langage mais une technique. Objectif: sur clic de bouton de formulaire, on souhaite insérer un prénom dans la table employes, et recevoir une confirmation -->
</body>
</html>