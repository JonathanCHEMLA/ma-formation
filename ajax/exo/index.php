<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Jeu</title>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="ajax.js"></script>
</head>
<body>

    <button type="button" id="debut">Démarrer le jeu</button>

    <div id="joueur">
        <form method="post" action="#">
            <fieldset>
            <input type="text" id="propo">
            <input type="submit" id="envoi" value="envoi">
            </fieldset>
        </form>
    </div>

    <div id="resultat"></div>

</body>
</html>