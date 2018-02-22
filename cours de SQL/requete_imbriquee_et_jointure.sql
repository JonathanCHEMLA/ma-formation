--# Création de la BDD
CREATE DATABASE bibliotheque;
--# on se positionne sur la BDD
Use bibliotheque;

--# Faire un copier/coller du contenu du fichier bibliotheque.sql


--# Si on veut vérifier que nos tables ont bien été enregistrées et vérifier qu'elles sont bien remplies:
SHOW TABLES;
SELECT * FROM abonne; SELECT * FROM emprunt; SELECT * FROM livre;

--# NULL ne peut pas etre testé avec "=". cette valeur se teste avec IS/IS NOT

--# Afficher les id livres qui n'ont pas été rendus
SELECT id_livre FROM emprunt WHERE date_rendu IS NULL;

--# Affichage des titres des livres qui n'ont pas été rendus à la bibliothèque
SELECT titre FROM livre WHERE id_livre IN 
	(SELECT id_livre FROM emprunt WHERE date_rendu IS NULL);	/*  Attention à bien mettre un IN au lieu de "="   */
--# Affichage des prenom des abonnés qui n'ont pas rendu leur livre à la bibliothèque	
SELECT prenom FROM abonne WHERE id_abonne IN (SELECT id_abonne FROM emprunt WHERE date_rendu IS NULL);

--# Les jointures répondent à tous les cas de figure. Les imbriquées ne répondent qu'aux requetes d'une seule table. Mais les imbriquées sont plus rapide que les jointures. (de meme le IF est tjrs plus rapide que le switch case.)

--# Affichage des id_livre que Chloé	a emprunté à la bibliothèque
	SELECT id_livre from emprunt WHERE id_abonne = (SELECT id_abonne FROM abonne WHERE prenom="chloe");/*Fonctionne aussi avec le IN */
	
--# Affichage des prénoms des abonnés ayant emprunté un livre le 19-12-2014
	SELECT prenom 
	FROM abonne 
	WHERE id_abonne IN 
		(SELECT id_abonne 
		FROM emprunt 
		WHERE date_sortie="2014-12-19");

--# Affichage du nombre de livres que Guillaume a déjà emprunté à la bibliothèque
SELECT COUNT(id_livre) AS NBRE_DE_LIVRE 
FROM emprunt 
WHERE id_abonne= 
	(SELECT id_abonne 
	FROM abonne 

	WHERE prenom= "guillaume"); /*si on avait considéré que le client avait emprunté plusiurs fois le meme livre, on aurait pu rester sur 2 tables en appliquant un simple DISTINCT devant COUNT(id_livre)*/


--# Afffichage des prénoms des abonnés ayant déjà emprunté un ilvre d'Alphonse DAUDET
SELECT * FROM abonne WHERE id_abonne IN (SELECT id_abonne FROM emprunt WHERE id_livre IN (SELECT id_livre FROM LIVRE WHERE auteur LIKE "%daudet")); /*SQL n'est pas sensible a la casse meme pour les valeurs des champs*/ 
--# ou encore:
SELECT * FROM abonne WHERE id_abonne IN (SELECT id_abonne FROM emprunt WHERE id_livre IN (SELECT id_livre FROM LIVRE WHERE auteur = "ALPHONSE DAUDET"));
	
--# Nous aimerions connaitre le ou les titres du/des livres empruntés par chloé	
SELECT * FROM livre WHERE id_livre IN (SELECT id_livre FROM emprunt WHERE id_abonne IN (SELECT id_abonne FROM abonne WHERE prenom= "CHLOE"));
--# Nous aimerions connaitre le ou les titres du/des livres que n'a pas empruntés chloé	
SELECT * FROM livre WHERE id_livre NOT IN (SELECT id_livre FROM emprunt WHERE id_abonne IN (SELECT id_abonne FROM abonne WHERE prenom= "CHLOE"));
--# Nous aimerions maintenant connaitre le ou les titres du/des livres que Chloé n'a pas encore rendu	
SELECT * FROM livre WHERE id_livre IN (SELECT id_livre FROM emprunt WHERE id_abonne IN (SELECT id_abonne FROM abonne WHERE prenom= "CHLOE") AND date_rendu IS NULL);
--# ou encore:
SELECT * FROM livre WHERE id_livre IN (SELECT id_livre FROM emprunt WHERE date_rendu IS NULL  AND id_abonne IN (SELECT id_abonne FROM abonne WHERE prenom= "CHLOE"));

--# QUI A EMPRUNTE LE PLUS DE LIVRES?
select * from abonne WHERE id_abonne=(select id_abonne FROM emprunt group by id_abonne order by COUNT(id_livre) DESC LIMIT 0,1);
--# CETTE LIGNE NE FONCTIONNE PAS CAR LE GROUP BY DOIT VENIR AVANT LE ORDER BY:
select * from abonne WHERE id_abonne=(select id_abonne FROM emprunt order by COUNT(id_livre) DESC group by id_abonne LIMIT 0,1);

--# LA JOINTURE EST TOUJOURS FAISABLE QQ SOIT LA REQUETE
--# Nous aimerions connaitre les dates de rendu et de sortie pour l'abonné Guilaume
SELECT date_rendu, date_sortie, prenom 
FROM abonne, emprunt 
WHERE prenom = "guillaume" 
AND emprunt.id_abonne = abonne.id_abonne;
+------------+-------------+-----------+
| date_rendu | date_sortie | prenom    |
+------------+-------------+-----------+
| 2014-12-18 | 2014-12-17  | Guillaume |
| 2014-12-28 | 2014-12-19  | Guillaume |
+------------+-------------+-----------+
SELECT e.date_rendu, e.date_sortie, a.prenom 
FROM abonne a, emprunt e
WHERE a.prenom = "guillaume" 
AND e.id_abonne = a.id_abonne;

--# Refaire la requete en imbriqué:
Select date_rendu, date_sortie from emprunt WHERE id_abonne=(select id_abonne from abonne where prenom="guillaume");
+------------+-------------+
| date_rendu | date_sortie |
+------------+-------------+
| 2014-12-18 | 2014-12-17  |
| 2014-12-28 | 2014-12-19  |
+------------+-------------+
--# En requete imbriquée on ne peut pas afficher le prenom car il appartient a une autre table. C'est soit l'une soit l'autre table mais pas les 2!

--# Nous aimerions connaitre les dates de sortie et de rendu pour le(s) livre(s) écrit(s) par Alphonse DAUDET

--# 1ere ligne : ce que l'on doit afficher
--# 2eme ligne : les tables dont nous avons besoin
--# 3eme ligne et les suivantes: la/les conditions
--# ensuite, si besoin les GROUP BY / ORDER BY ...
SELECT date_sortie, date_rendu, auteur FROM emprunt e, livre l WHERE e.id_livre=l.id_livre and auteur="ALPHONSE DAUDET"; 


--# Qui a emprunté le livre "une vie" sur l'année 2014:
SELECT prenom,titre,date_sortie AS DATE_EMPRUNTEE FROM abonne a, emprunt e, livre l WHERE e.id_livre=l.id_livre and e.id_abonne=a.id_abonne and titre= "une vie" AND date_sortie BETWEEN "2014-01-01" AND "2014-12-31"; 
--# ou encore:
SELECT prenom,titre,date_sortie AS DATE_EMPRUNTEE FROM abonne a, emprunt e, livre l WHERE e.id_livre=l.id_livre and e.id_abonne=a.id_abonne and titre= "une vie" AND date_sortie LIKE "2014%"; 

--# Nous aimerions connaitre le nombre de livres empruntés par chaque abonnés
SELECT count(e.id_livre) AS Nb_de_livres_empruntes, a.prenom 
FROM emprunt e, abonne a 
WHERE e.id_abonne=a.id_abonne 
group by prenom 
order by Nb_de_livres_empruntes DESC 
LIMIT 0,1;  

/* Attention le "é" renvoi une erreur de syntaxe dans Nb_de_livres_empruntés. Cependant "NB de livres empruntés" fonctionne */ 

/*le COUNT, il vaut mieux toujours l'appliquer sur le id car le champ id ne peut pas etre vide*/

--# Nous aimerions connaitre le nombre de livre à rendre pour chaque abonné:
SELECT prenom,count(id_livre) AS Nombre_de_livres_a_rendre
FROM abonne a, emprunt e
WHERE e.id_abonne=a.id_abonne
AND date_rendu IS NULL 
GROUP BY prenom;

--# QUI a pris Quoi et Quand ?
select prenom, titre, date_sortie
FROM abonne a, emprunt e, livre l
WHERE a.id_abonne = e.id_abonne
AND l.id_livre = e.id_livre;

insert into abonne values(NULL,"jonathan");
--ou encore:
insert into abonne(prenom) VALUES('Jonathan');

--#Affichage des prenoms avec les id_livre qu'ils ont emprunté.
SELECT a.prenom,e.id_livre
FROM emprunt e,abonne a
WHERE a.id_abonne= e.id_abonne;

--# JOINTURES EXTERNES (sans correspondance exigée)
						__________________________
						
SELECT a.prenom,e.id_livre, l.auteur FROM abonne a LEFT JOIN emprunt e ON e.id_abonne=a.id_abonne; /*ON c est la meme chose qu un WHERE sur un LEFT/RIGHT JOIN. LE LEFT/RIGHT donne la priorité d'affichage de la table. LEFT/RIGHT combiné au ON va demander d'afficher également, s'il existent, les lignes ayant un champ id NULL à GAUCHE/DROITE, en fonction du LEFT/RIGHT JOIN   */

/*on affiche TOUS LES ABONNES SANS EXCEPTION ! */ 

+-----------+----------+
| prenom    | id_livre |
+-----------+----------+
| Guillaume |      100 |
| Benoit    |      101 |
| Chloe     |      100 |
| Laura     |      103 |
| Guillaume |      104 |
| Benoit    |      105 |
| Chloe     |      105 |
| Benoit    |      100 |
| jonathan  |     NULL |
+-----------+----------+
--# De meme, sur 3 tables, 
SELECT a.prenom, e.id_livre, l.auteur 
FROM abonne a
LEFT JOIN emprunt e ON e.id_abonne=a.id_abonne
LEFT JOIN livre l ON e.id_livre=l.id_livre;

/*ATTENTION : si on commence avec un left, on doit n'utliser que des left pour le reste des tables jointes. Et inversement pour le right*/

+-----------+----------+-------------------+
| prenom    | id_livre | auteur            |
+-----------+----------+-------------------+
| Guillaume |      100 | GUY DE MAUPASSANT |
| Benoit    |      101 | GUY DE MAUPASSANT |
| Chloe     |      100 | GUY DE MAUPASSANT |
| Laura     |      103 | ALPHONSE DAUDET   |
| Guillaume |      104 | ALEXANDRE DUMAS   |
| Benoit    |      105 | ALEXANDRE DUMAS   |
| Chloe     |      105 | ALEXANDRE DUMAS   |
| Benoit    |      100 | GUY DE MAUPASSANT |
| jonathan  |     NULL | NULL              |
+-----------+----------+-------------------+

/*la priorite ici c est abonne qui est celui de gauche(left) */
--# La jointure externe permet de donner la priorité a une table sur laquelle on récupère tout le contenu demandé ( sur les exemples au dessus, les prénoms de la table abonne) puis on rajoute les informations des autres tables sur la base des relations.(emprunt.id_abonne doit être égal à abonne.id_abonne)

