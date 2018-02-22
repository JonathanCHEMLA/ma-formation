--# TABLES TEMPORAIRES

Permet de faire des requetes sur une requetes deja effectuee grace a un CREATE 

la base de donneees est un sac: tu jette dedans tout ce que tu

permet de tester nos recherches avant !

USE bibliotheque;
CREATE TEMPORARY TABLE emprunt2014 AS SELECT * FROM emprunt WHERE date_sortie like '2014%';

SHOW TABLES;
SELECT * FROM emprunt2014;

+------------+----------+-----------+-------------+------------+
| id_emprunt | id_livre | id_abonne | date_sortie | date_rendu |
+------------+----------+-----------+-------------+------------+
|          1 |      100 |         1 | 2014-12-17  | 2014-12-18 |
|          2 |      101 |         2 | 2014-12-18  | 2014-12-20 |
|          3 |      100 |         3 | 2014-12-19  | 2014-12-22 |
|          4 |      103 |         4 | 2014-12-19  | 2014-12-22 |
|          5 |      104 |         1 | 2014-12-19  | 2014-12-28 |
+------------+----------+-----------+-------------+------------+
--# si je ferme et reouvre ensuite la console et fait:
USE bibliotheque;
SELECT * FROM emprunt2014;
--# il n'existe plus le resultat du dessus. 

--# Autre point important: les données ne sont pas partagées.
--# Une table temporaire est construite à partir d'une requête et de colonnes de tables existantes.
--# c'est pratique pour ISOLER des résultats SANS IMPACTER les données d'origine. Ce principe est valable dans les 2 SENS.
--# ATTENTION: les données d'une table temporaire ne sont pas liées aux donnéées d'origine. Si je modifie une données sur la table temporaire, cela n'impactera pas les données sur la table d'origine.

--# Duree de vie très courte. Si je ferme la console (cession) la table est supprimee automatiquement.


/*
resume:
Pour les 2 systemes de table:
ISOLER des informations.


virtuelle:
les info isolees sont communes avec les donnees d origine: les donnes sont impactee
duree de vie illimitee. C est a nous de la supprimer

temporaire:
ces donnees ne sont plus liees aux donnees d origine
interet: c est conseille pour faire des test, des controles.
si par la suite je suis satisfait sur mes donnees d origine.

Si, ce que j'ai tape me convient et que je veux les sauvegarder,
je dois faire un copier/ coller de toutes les requetes precedemment tappees avec la table temporaire, en le faisant normalement( c est a dire sans taper table temporary...)

*/