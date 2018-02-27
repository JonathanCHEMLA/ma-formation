--# Creation de la BDD
CREATE DATABASE bibliotheque;
--# on se positionne sur la BDD
USE bibliotheque;

--# faire un copier coller du contenu du fichier bibliotheque.sql

SHOW TABLES;
SELECT * FROM abonne; SELECT * FROM emprunt; SELECT * FROM livre;

--# la valeur NULL se test avec IS / IS NOT
--# afficher les id livres qui n'ont pas été rendus
SELECT id_livre FROM emprunt WHERE date_rendu IS NULL;

--# affichage des titres des livres qui n'ont pas ete rendus à la bibliotheque
SELECT titre FROM livre WHERE id_livre IN  
	(SELECT id_livre FROM emprunt WHERE date_rendu IS NULL);

--# affichage des prenoms des abonnes n'ayant pas encore rendu un livre emprunte
SELECT prenom FROM abonne WHERE id_abonne IN 
	(SELECT id_abonne FROM emprunt WHERE date_rendu is NULL);

--# affichage des id_livre que Chloé a emprunté à la bibliotheque
SELECT id_livre FROM emprunt WHERE id_abonne IN 
	(SELECT id_abonne FROM abonne WHERE prenom = 'chloe');

--# affichage des abonnes ayant emprunte un livre le 19.12.2014
SELECT prenom FROM abonne WHERE id_abonne IN
	 (SELECT id_abonne FROM emprunt WHERE date_sortie = '2014-12-19' );

--# affichade du nombre de livre que Guillaume a deja emprunté à la bibliotheque
SELECT COUNT(id_livre) FROM livre WHERE id_livre IN
	(SELECT id_emprunt FROM emprunt WHERE id_emprunt = '1' AND date_rendu < CURDATE()); NOT
-- CORRECTION
SELECT COUNT(*) AS "nb de livre" FROM emprunt WHERE id_abonne IN
	(SELECT id_abonne FROM abonne WHERE prenom = 'Guillaume');

--# affichage des prenoms des abonnes ayant deja emprunte des livres d'alphonse daudet
SELECT prenom FROM abonne WHERE id_abonne IN
	(SELECT id_abonne FROM emprunt WHERE date_rendu != "NULL" IN
		(SELECT id_livre FROM livre WHERE auteur = " Alphonse Daudet"));

-- CORRECTION
SELECT prenom FROM abonne WHERE id_abonne IN
	(SELECT id_abonne FROM emprunt WHERE id_livre IN
		(SELECT id_livre FROM livre WHERE auteur = "alphonse daudet"));

--# 1 -- nous aimerions connaitre le(s) titre(s) des livres empruntes par chloe
--# 2 -- nous aimerions connaitre le(s) titre(s) des livres que n'a pas empruntes chloe

SELECT titre FROM livre WHERE id_emprunt IN
	(SELECT id_emprunt FROM emprunt WHERE id_livre IN
		(SELECT id_livre IN livre WHERE prenom IN
			(SELECT prenom FROM abonne WHERE prenom = 'chloe')));

-- CORRECTION 1
SELECT titre FROM livre WHERE id_livre IN
	(SELECT id_livre FROM emprunt WHERE id_abonne IN
		(SELECT id_abonne FROM abonne WHERE prenom = "chloe"));

-- CORRECTION 2
SELECT titre FROM livre WHERE id_livre IN
	(SELECT id_livre FROM emprunt WHERE id_abonne NOT IN
		(SELECT id_abonne FROM abonne WHERE prenom = "chloe"));

--# nous aimerions maintenant connaitre le(s) titre(s) des livres que chloe n'a pas encore rendu à la bibli
SELECT titre FROM livre WHERE id_livre IN
	(SELECT id_livre FROM emprunt WHERE date_rendu IS NULL AND id_abonne IN
		(SELECT id_abonne FROM abonne WHERE prenom = "chloe" ));

--# Qui a emprunté le plus de livre à la bibliotheque order et group by count et limit ?
SELECT prenom FROM abonne WHERE id_abonne 
	(SELECT id_abonne FROM emprunt GROUP BY id_abonne ORDER BY COUNT(id_abonne) DESC LIMIT 0, 1); -- imbriq

SELECT abonne.prenom, COUNT(emprunt.id_abonne) AS 'nombre de livre' -- jointure
FROM abonne, empruntGROUP BY emprunt.id_abonne
WHERE abonne.id_abonne = emprunt.id_abonne
ORDER BY COUNT(emprunt.id_abonne) DESC
LIMIT 0, 1;


--# REQUETES EN JOINTURE

--# nous aimerions connaitre les dates de rendu et de sortie pour l'abonne guillaume
SELECT date_rendu, date_sortie, prenom
FROM abonne, emprunt
WHERE prenom = "guillaume"
AND abonne.id_abonne = emprunt.id_abonne;

SELECT date_rendu, date_sortie, prenom -- qd on surnome les noms 
FROM abonne a, emprunt e
WHERE prenom = "guillaume"
AND a.id_abonne = e.id_abonne;

--# refaire la requete en imbriquée sans afficher le prenom dans ce cas
SELECT date_rendu, date_sortie FROM emprunt WHERE id_abonne IN
	(SELECT id_abonne FROM abonne WHERE prenom = 'guillaume');

--# nous aimerions connaitre les dates de sortie et de rendu pour le(s) livre(s) ecrits par alphonse daudet
SELECT date_rendu, date_sortie, auteur
FROM emprunt, livre
WHERE auteur = "alphonse daudet"
AND emprunt.id_livre = livre.auteur; NOO

SELECT date_rendu, date_sortie, auteur
FROM emprunt, livre
WHERE auteur = "alphonse daudet"
AND emprunt.id_livre = livre.id_livre; OKAAAYYYYES GOOD CORRECTION

--# qui a emprunté le livre "une vie" sur l'année 2014 ?
SELECT prenom, titre, date_sortie,
FROM abonne, livre, emprunt 
WHERE date_sortie LIKE '%2014%'
AND titre = "une vie";
AND abonne.prenom = emprunt.id_livre = livre.id_livre; NOOOO

SELECT prenom, date_sortie, titre
FROM abonne, livre, emprunt 
WHERE date_sortie LIKE '2014%'
AND titre = "une vie"
AND emprunt.id_livre = livre.id_livre
AND abonne.id_abonne = emprunt.id_abonne; YEEEESSSS


--# nous aimerions connaitre le nombre de livre emprunté par chaque abonné
SELECT titre, date_sortie, prenom
FROM livre, emprunt, abonné
WHERE COUNT(id_emprunt) NOOOOOOOOOOOOOOOO

SELECT abonne.prenom, COUNT(emprunt.id_livre) AS 'nombre de livre'
FROM abonne, emprunt
WHERE abonne.id_abonne = emprunt.id_abonne
GROUP BY abonne.prenom; YESSSSSS


SELECT abonne.prenom, COUNT(emprunt.id_livre) AS 'nombre de livre'
FROM abonne, emprunt
WHERE abonne.id_abonne = emprunt.id_abonne
GROUP BY abonne.prenom
ORDER BY COUNT(emprunt.id_livre) DESC -- ce qui permet de mettre dans le bon ordre
LIMIT 0, 1;

--# Nous aimerions connaitre le nombre de livre à rendre pour chaque abonné
SELECT abonne.prenom, COUNT(emprunt.date_sortie) AS 'livres à rendre'
FROM abonne, emprunt
WHERE abonne.id_abonne = emprunt.id_abonne
AND date_sortie = "NULL"
GROUP BY abonne.prenom;

SELECT abonne.prenom, COUNT(emprunt.date_sortie) AS 'livres à rendre'
FROM abonne, emprunt
WHERE date_sortie = "NULL"
AND abonne.id_abonne = emprunt.id_abonne
AND emprunt.date_sortie = emprunt.id_emprunt
GROUP BY abonne.prenom;

SELECT abonne.prenom, COUNT(emprunt.id_livre) AS 'livres à rendre'
FROM abonne, emprunt
WHERE abonne.id_abonne = emprunt.id_abonne
AND date_rendu IS NULL
GROUP BY abonne.prenom; OKKKK

--# qui a pris quoi et quand ?
SELECT prenom, titre, date_sortie
FROM abonne, livre, emprunt
WHERE abonne.id_abonne = emprunt.id_abonne
AND emprunt.id_livre = livre.id_livre; YEEEESSSS

--# rajoutez vous dans la table abonné
INSERT INTO abonne (prenom) VALUES('Hana');
SELECT*FROM abonne;

--# affichage des prenoms avec les id_livre qu'ils ont emprunté
SELECT abonne.prenom, emprunt.id_livre
FROM emprunt, abonne
WHERE abonne.id_abonne = emprunt.id_abonne;

--# JOINTURES EXTERNES ( sans correspondance exigee )
SELECT abonne.prenom, emprunt.id_livre
FROM abonne
LEFT JOIN emprunt ON emprunt.id_abonne = abonne.id_abonne

 -- meme chose en inversant le sens
SELECT abonne.prenom, emprunt.id_livre
FROM emprunt
RIGHT JOIN abonne ON emprunt.id_abonne = abonne.id_abonne

-- même chose sur 3 tables
SELECT abonne.prenom, emprunt.id_livre, livre.auteur
FROM abonne
LEFT JOIN emprunt ON emprunt.id_abonne = abonne.id_abonne
LEFT JOIN livre ON emprunt.id_livre = livre.id_livre;

--# la jointure externe permet de donner la priorité à une table sur laquelle on recupere tout le contenu demandé (sur les exemples au dessus les prenoms de la tabmes abonne) puis on rajouter les infos des autres tables sur la base des relations ( id_abonne doit etre egzl à id_abonne)

