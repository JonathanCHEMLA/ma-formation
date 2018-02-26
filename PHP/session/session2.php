<?php
session_start();    // lorsque j'effectue un session start(), la session n'est pas recréée car elle existe déjà (grace au session_start() lancé dans le fichier session1)
echo '<pre>'; print_r($_SESSION); echo '</pre>';// affiche des informations contenues dans la session.

/**
 * Les informations d'une session sont enregistrées dans la session, coté serveur.
 * Cela crée (dans le meme temps) un cookie precisemment le meme que l'identifiant de la session, sur le pc du client.
 * Il ne pourra pas etre modifie par l'internaute car il s'agit d'un fichier directement enregistré sur le serveur.
 * Les sessions permettent d'avoir une connection constante à un site.
 * Sans elle, on ne pourrait pas naviguer sur les differentes pages du site car alors on serait constamment déconnecté.
 *  
 */

