
--# la "table virtuelle" s'appelle aussi une "vue"

--#les requetes ca donne des tables. c'est une solution à la requete piege que j'ai posé à Mathieu
USE entreprise;
CREATE VIEW vue_homme AS SELECT * FROM employes WHERE sexe= "m";

show tables;

+----------------------+
| Tables_in_entreprise |
+----------------------+
| employes             |
| vue_homme            |
+----------------------+

/*l'interet de VIEW est de pouvoir ISOLER des informations selon un critère pour pouvoir travailler sur ces info plus facilement*/

MariaDB [entreprise]> select * from vue_homme;
+-------------+-------------+---------+------+--------------+---------------+---------+
| id_employes | prenom      | nom     | sexe | service      | date_embauche | salaire |
+-------------+-------------+---------+------+--------------+---------------+---------+
|         350 | Jean-pierre | Laborde | m    | direction    | 1999-12-09    |    5000 |
|         388 | Clement     | Gallet  | m    | commercial   | 2000-01-15    |    2300 |
|         415 | Thomas      | Winter  | m    | commercial   | 2000-05-03    |    3550 |
|         509 | Fabrice     | Grand   | m    | comptabilite | 2003-02-20    |    1900 |
|         627 | Guillaume   | Miller  | m    | commercial   | 2006-07-02    |    1900 |
|         699 | Julien      | Cottet  | m    | secretariat  | 2007-01-18    |    1390 |
|         701 | Mathieu     | Vignal  | m    | informatique | 2008-12-03    |    2000 |
|         739 | Thierry     | Desprez | m    | secretariat  | 2009-11-17    |    1500 |
|         802 | Damien      | Durand  | m    | informatique | 2010-07-05    |    2250 |
|         854 | Daniel      | Chevel  | m    | informatique | 2011-09-28    |    1700 |
|         900 | Benoit      | Lagarde | m    | production   | 2013-01-03    |    2550 |
+-------------+-------------+---------+------+--------------+---------------+---------+

/*important : ATTENTION ! si je modifie une donnee dans la table virtuelle, la table originale sera modifiée */

Pour supprimer une vue:
DROP VIEW vue_homme;


--# SCHEMA = Base de données
--#ainsi ca revient au meme d'ecrire : 
CREATE SCHEMA entreprise;
--#ou 
CREATE DATABASE entreprise;


--#Pour voir les vues:
USE information_schema;
SELECT * FROM views;
--# Dans les lignes ci-dessus, on va chercher a afficher une table, appellée "views", que nous n'avons pas créé nous meme, et qui se trouver dans la BDD "information_schema". Pour info, cette Bdd est créée SYSTEMATIQUEMENT, PAR DEFAUT avec phpmyadmin


-- CREATE DATABASE = CREATE SCHEMA 

/*ASTUCE: pour un pb d'affichage de notre tableau du fait du grand nb de colonnes, on peut reduire la police de caractere en cliquant en haut a gauche de la console*/ 
--# A chaque fois que l'on appelle notre vue, il va aller effectuer la requete: SELECT * FROM employes WHERE sexe= "m";

--# Dans une table virtuelle ( vue ) nous sauvegardons la requete permettant d'arriver à ce resultat (qui est, ici:SELECT*FROM employes WHERE sexe = 'm';)
--# pratique pour isoler des informations issues d'une requete compliquée pour ensuite faire d'autres requetes sur ce resultat.
--# ATTENTION : les données de la table virtuelle sont les mêmes que celles d'origine.Donc, si je modifie une donnée sur la table virtuelle, cette donnee sera aussi modifiee sur la table d'origine et l'inverse egalement.