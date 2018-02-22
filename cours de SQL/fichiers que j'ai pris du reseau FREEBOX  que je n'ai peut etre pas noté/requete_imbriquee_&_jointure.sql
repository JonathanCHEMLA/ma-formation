--# Création de la BDD
CREATE DATABASE bibliotheque;
--# On se positionne sur la BDD
USE bibliotheque;

--# Faire un copier/coller du contenu du fichier bibliotheque.sql

SHOW TABLES;
SELECT * FROM abonne; SELECT * FROM emprunt; SELECT * FROM livre;

--# la valeur NULL se test avec IS / IS NOT
--# Afficher les id livres qui n'ont pas été rendus
SELECT id_livre FROM emprunt WHERE date_rendu IS NULL;
+----------+
| id_livre |
+----------+
|      105 |
|      100 |
+----------+

--# Affichage des titres des livres qui n'ont pas été rendus à la bibliothèque
SELECT titre FROM livre WHERE id_livre IN 
	(SELECT id_livre FROM emprunt WHERE date_rendu IS NULL);

	
--# Affichage des prénoms des abonnés n'ayant pas encore rendu un livre emprunté.
SELECT prenom FROM abonne WHERE id_abonne IN 
	(SELECT id_abonne FROM emprunt WHERE date_rendu IS NULL);	
	
--# Affichage des id_livres que Chloé à emprunté à la bibliothèque.
SELECT id_livre FROM emprunt WHERE id_abonne IN 
	(SELECT id_abonne FROM abonne WHERE prenom = 'chloe');
+----------+
| id_livre |
+----------+
|      100 |
|      105 |
+----------+

--# Affichage des prénoms des abonnés ayant emprunté un livre le 19/12/2014
SELECT prenom 
FROM abonne 
WHERE id_abonne IN 
	(	SELECT id_abonne 
		FROM emprunt 
		WHERE date_sortie = '2014-12-19');
+-----------+
| prenom    |
+-----------+
| Guillaume |
| Chloe     |
| Laura     |
+-----------+

--# Affichage du nombre de livre que Guillaume a déjà emprunté à la bibliothèque
SELECT COUNT(*) AS 'nb de livre' FROM emprunt WHERE id_abonne IN (SELECT id_abonne FROM abonne WHERE prenom = "guillaume");
+-------------+
| nb de livre |
+-------------+
|           2 |
+-------------+

--# Affichage des prénoms des abonnés ayant déjà emprunté un livre d'Alphonse Daudet
SELECT prenom FROM abonne WHERE id_abonne IN 
	(SELECT id_abonne FROM emprunt WHERE id_livre IN 
		(SELECT id_livre FROM livre WHERE auteur = "alphonse daudet"));
+--------+
| prenom |
+--------+
| Laura  |
+--------+

--# Nous aimerions connaitre le(s) titre(s) des livres empruntés par Chloé
--# Nous aimerions connaitre le(s) titre(s) des livres que n'a pas empruntés Chloé
SELECT titre FROM livre WHERE id_livre IN 
	(SELECT id_livre FROM emprunt WHERE id_abonne IN 
		(SELECT id_abonne FROM abonne WHERE prenom = "chloe"));
+-------------------------+
| titre                   |
+-------------------------+
| Une vie                 |
| Les Trois Mousquetaires |
+-------------------------+
SELECT titre FROM livre WHERE id_livre NOT IN 
	(SELECT id_livre FROM emprunt WHERE id_abonne IN 
		(SELECT id_abonne FROM abonne WHERE prenom = "chloe"));
+-----------------+
| titre           |
+-----------------+
| Bel-Ami         |
| Le père Goriot  |
| Le Petit chose  |
| La Reine Margot |
+-----------------+		

--# Nous aimerions maintenant connaitre le(s) titre(s) des livres que Chloe n'a pas encore rendu à la bibliotheque
SELECT titre FROM livre WHERE id_livre IN 
	(SELECT id_livre FROM emprunt WHERE date_rendu IS NULL AND id_abonne IN 
		(SELECT id_abonne FROM abonne WHERE prenom = "chloe"));
+-------------------------+
| titre                   |
+-------------------------+
| Les Trois Mousquetaires |
+-------------------------+

--# Qui (prénom) a emprunté le plus de livre à la bibliothèque.
SELECT prenom FROM abonne WHERE id_abonne = 
	(SELECT id_abonne FROM emprunt GROUP BY id_abonne ORDER BY COUNT(id_abonne) DESC LIMIT 0, 1);
+---------+
| prenom  |
+---------+
| Benoit  |
+---------+	
SELECT abonne.prenom, COUNT(emprunt.id_abonne) AS 'nombre de livre' 
FROM abonne, emprunt
WHERE abonne.id_abonne = emprunt.id_abonne 
GROUP BY emprunt.id_abonne 
ORDER BY COUNT(emprunt.id_abonne) DESC 
LIMIT 0, 1;
+--------+-----------------+
| prenom | nombre de livre |
+--------+-----------------+
| Benoit |               3 |
+--------+-----------------+


-- ORDER BY
-- GROUP BY
-- COUNT
-- LIMIT


--# REQUETES EN JOINTURE

--# nous aimerions connaitre les dates de rendu et de sortie pour l'abonné Guillaume

SELECT emprunt.date_rendu, emprunt.date_sortie, abonne.prenom 
FROM abonne, emprunt 
WHERE abonne.prenom = "guillaume" 
AND abonne.id_abonne = emprunt.id_abonne;
+------------+-------------+-----------+
| date_rendu | date_sortie | prenom    |
+------------+-------------+-----------+
| 2014-12-18 | 2014-12-17  | Guillaume |
| 2014-12-28 | 2014-12-19  | Guillaume |
+------------+-------------+-----------+
SELECT e.date_rendu, e.date_sortie, a.prenom 
FROM abonne a, emprunt e 
WHERE a.prenom = "guillaume" 
AND a.id_abonne = e.id_abonne;

--# refaire la requete en imbriquée sans afficher le prenom dans ce cas.
SELECT date_rendu, date_sortie FROM emprunt WHERE id_abonne IN (SELECT id_abonne FROM abonne WHERE prenom = 'guillaume');
+------------+-------------+
| date_rendu | date_sortie |
+------------+-------------+
| 2014-12-18 | 2014-12-17  |
| 2014-12-28 | 2014-12-19  |
+------------+-------------+

--# Nous aimerions connaitre les dates de sortie et de rendu pour le(s) livre(s) écrit par Alphonse Daudet
--# 1ère ligne: ce que l'on doit afficher
--# 2ème ligne: les tables dont nous avons besoin
--# 3ème et les suivantes la ou les conditions 
--# Ensuite si besoin les GROUP BY / ORDER BY etc...
SELECT emprunt.date_rendu, emprunt.date_sortie, livre.auteur 
FROM emprunt, livre  
WHERE emprunt.id_livre = livre.id_livre  
AND livre.auteur = 'alphonse daudet' ;
+------------+-------------+
| date_rendu | date_sortie |
+------------+-------------+
| 2014-12-22 | 2014-12-19  |
+------------+-------------+
+------------+-------------+-----------------+
| date_rendu | date_sortie | auteur          |
+------------+-------------+-----------------+
| 2014-12-22 | 2014-12-19  | ALPHONSE DAUDET |
+------------+-------------+-----------------+

--# Qui a emprunté le livre "une vie" sur l'année 2014
SELECT abonne.prenom, emprunt.date_sortie, livre.titre 
FROM abonne, livre, emprunt 
WHERE livre.titre = 'une vie' 
AND emprunt.date_sortie LIKE '2014%' 
AND emprunt.id_livre = livre.id_livre
AND abonne.id_abonne = emprunt.id_abonne;
+-----------+-------------+---------+
| prenom    | date_sortie | titre   |
+-----------+-------------+---------+
| Guillaume | 2014-12-17  | Une vie |
| Chloe     | 2014-12-19  | Une vie |
+-----------+-------------+---------+

--# Nous aimerions connaitre le nombre de livre emprunté par chaque abonné
SELECT abonne.prenom, COUNT(emprunt.id_livre) AS 'nombre de livre' 
FROM abonne, emprunt 
WHERE abonne.id_abonne = emprunt.id_abonne 
GROUP BY abonne.prenom; 
+-----------+-----------------+
| prenom    | nombre de livre |
+-----------+-----------------+
| Benoit    |               3 |
| Chloe     |               2 |
| Guillaume |               2 |
| Laura     |               1 |
+-----------+-----------------+
SELECT abonne.prenom, COUNT(emprunt.id_livre) AS 'nombre de livre' 
FROM abonne, emprunt 
WHERE abonne.id_abonne = emprunt.id_abonne 
GROUP BY abonne.prenom
ORDER BY COUNT(emprunt.id_livre) DESC
LIMIT 0, 1; 

--# Nous aimerions connaitre le nombre de livre à rendre pour chaque abonné
SELECT abonne.prenom, COUNT(emprunt.id_livre) AS 'nombre de livre' 
FROM abonne, emprunt 
WHERE abonne.id_abonne = emprunt.id_abonne 
AND emprunt.date_rendu IS NULL 
GROUP BY abonne.prenom; 
+--------+-----------------+
| prenom | nombre de livre |
+--------+-----------------+
| Benoit |               1 |
| Chloe  |               1 |
+--------+-----------------+

--# Qui a pris Quoi et Quand ?
SELECT abonne.prenom, livre.titre, emprunt.date_sortie 
FROM abonne, emprunt, livre 
WHERE abonne.id_abonne = emprunt.id_abonne 
AND livre.id_livre = emprunt.id_livre;


--# Rajoutez-vous dans la table abonné
INSERT INTO abonne (prenom) VALUES ('Mathieu');
SELECT * FROM abonne;

--# Affichage des prenoms avec les id_livre qu'ils ont emprunté
SELECT abonne.prenom, emprunt.id_livre
FROM emprunt, abonne 
WHERE abonne.id_abonne = emprunt.id_abonne;

--# JOINTURES EXTERNES (sans correspondance exigée)
SELECT abonne.prenom, emprunt.id_livre
FROM abonne 
LEFT JOIN emprunt ON emprunt.id_abonne = abonne.id_abonne;

--# même chose en inversant le sens
SELECT abonne.prenom, emprunt.id_livre
FROM  emprunt
RIGHT JOIN abonne ON emprunt.id_abonne = abonne.id_abonne;


--# Même chose sur 3 tables
SELECT abonne.prenom, emprunt.id_livre, livre.auteur
FROM abonne 
LEFT JOIN emprunt ON emprunt.id_abonne = abonne.id_abonne
LEFT JOIN livre ON emprunt.id_livre = livre.id_livre;

--# La jointure externe permet de donner la priorité à une table sur laquelle on récupère tout le contenu demandé (sur les exemples au dessus les prénoms de la table abonne) puis on rajoute les informations des autres tables sur la base des relations.(emprunt.id_abonne doit être égal à abonne.id_abonne)

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
| Mathieu   |     NULL | NULL              |
+-----------+----------+-------------------+

















