<?php
session_start(); // lorsque j'effectue un session_start(), la session n'est pas recrée car elle existe déja(grace au session_start() lancé dans le fichier session1)
echo '<pre>'; print_r($_SESSION); echo '</pre>'; // affiche des informations contenu dans la session

/*
Les informations d'une session sont enregistrées dans la session côté serveur, cela crée (dans le même temps) un cookie précisemment à l'identifiant de la session, sur le pc du client.
il ne pourra pas être modifié par l'internaute car il s'agit d'un fichier enregistré directement sur le serveur.
Les sessions permettent d'avoir une connexion constante à un site, sans elle on ne pourrait pas naviguer sur le site, on serait constamment déconnecter
*/