
--# UNION permet de fusionner plusieurs résulltats DANS UNE MEME COLONNE. Regrouper +eurs requetes en  1 seul resultat.


USE bibliotheque;
--# RASSEMBLER et afficher les auteurs et les abonnés DANS UNE SEULE ET MEME COLONNE
SELECT prenom AS 'liste des abonnés' FROM abonne UNION select auteur FROM livre;

--# 
SELECT prenom AS 'liste des abonnés' FROM abonne 
UNION
SELECT auteur FROM livre;
+-------------------+
| liste des abonnés |
+-------------------+
| Guillaume         |
| Benoit            |
| Chloe             |
| Laura             |
| jonathan          |
| GUY DE MAUPASSANT |
| HONORE DE BALZAC  |
| ALPHONSE DAUDET   |
| ALEXANDRE DUMAS   |
+-------------------+

--# UNION fait un DISTINCT par défaut
--# Pour avoir toutes les informations : UNION ALL
SELECT prenom AS 'liste des abonnés' FROM abonne 
UNION ALL
SELECT auteur FROM livre;
+-------------------+
| liste des abonnés |
+-------------------+
| Guillaume         |
| Benoit            |
| Chloe             |
| Laura             |
| jonathan          |
| GUY DE MAUPASSANT |
| GUY DE MAUPASSANT |
| HONORE DE BALZAC  |
| ALPHONSE DAUDET   |
| ALEXANDRE DUMAS   |
| ALEXANDRE DUMAS   |
+-------------------+
--# Permet de réunir par exemple tous les salaries de ETTER, tous les salaries de ALLIANCES EST et tous les salaries de Copy Mots Plus.

