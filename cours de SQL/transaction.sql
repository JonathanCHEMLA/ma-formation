--# TRANSACTION   AVANTAGF / au temporaire, les donnees sont directement impactées; (il n y a pas besoin de retaper nos requetes normalement ensuite.)

USE entreprise;
START TRANSACTION; --# Demarre la zone de la mise en tampon.

SELECT * FROM employes;
UPDATE employes SET prenom="test";
SELECT * FROM employes;

--# pour annuler TOUTES les opérations DEPUIS LE DEBUT de la transaction:
ROLLBACK; --# Efface, annule TOUT, depuis le START TRANSACTION.
SELECT * FROM employes;

--# Pour valider toutes les opérations DEPUIS LE DEBUT de la transaction:
COMMIT;

--# le ROLLBACK cloture TRANSACTION. COMMIT cloture la TRANSACTION
--# Si on ne valide pas la fin, par exemple, coupure de courant, RIEN NE SERA ENREGISTRE.ce sera un ROLLBACK par default.  c'est une securité pour nous!



------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
--# TRANSACTION AVANCEE & SAVEPOINT
START TRANSACTION;
SELECT * FROM employes;

SAVEPOINT point1;  --# point de sauvegarde
UPDATE employes SET salaire = 1000;
SELECT * FROM employes;


SAVEPOINT point2; --# ce n est pas une sauvegarde!
UPDATE employes SET salaire = 5000;
SELECT * FROM employes;

SAVEPOINT point3; --# ce n est pas une sauvegarde!
DELETE FROM employes;
SELECT * FROM employes;

------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
MariaDB [entreprise]> SELECT * FROM employes;
+-------------+-------------+----------+------+---------------+---------------+---------+
| id_employes | prenom      | nom      | sexe | service       | date_embauche | salaire |
+-------------+-------------+----------+------+---------------+---------------+---------+
|         350 | Jean-pierre | Laborde  | m    | direction     | 1999-12-09    |    5000 |
|         388 | Clement     | Gallet   | m    | commercial    | 2000-01-15    |    2300 |
|         415 | Thomas      | Winter   | m    | commercial    | 2000-05-03    |    3550 |
|         417 | Chloe       | Dubar    | f    | production    | 2001-09-05    |    1900 |
|         491 | Elodie      | Fellier  | f    | secretariat   | 2002-02-22    |    1600 |
|         509 | Fabrice     | Grand    | m    | comptabilite  | 2003-02-20    |    1900 |
|         547 | Melanie     | Collier  | f    | commercial    | 2004-09-08    |    3100 |
|         592 | Laura       | Blanchet | f    | direction     | 2005-06-09    |    4500 |
|         627 | Guillaume   | Miller   | m    | commercial    | 2006-07-02    |    1900 |
|         655 | Celine      | Perrin   | f    | commercial    | 2006-09-10    |    2700 |
|         699 | Julien      | Cottet   | m    | secretariat   | 2007-01-18    |    1390 |
|         701 | Mathieu     | Vignal   | m    | informatique  | 2008-12-03    |    2000 |
|         739 | Thierry     | Desprez  | m    | secretariat   | 2009-11-17    |    1500 |
|         780 | Amandine    | Thoyer   | f    | communication | 2010-01-23    |    1500 |
|         802 | Damien      | Durand   | m    | informatique  | 2010-07-05    |    2250 |
|         854 | Daniel      | Chevel   | m    | informatique  | 2011-09-28    |    1700 |
|         876 | Nathalie    | Martin   | f    | juridique     | 2012-01-12    |    3200 |
|         900 | Benoit      | Lagarde  | m    | production    | 2013-01-03    |    2550 |
|         933 | Emilie      | Sennard  | f    | commercial    | 2014-09-11    |    1800 |
|         990 | Stephanie   | Lafaye   | f    | assistant     | 2015-06-02    |    1775 |
+-------------+-------------+----------+------+---------------+---------------+---------+
20 rows in set (0.00 sec)

MariaDB [entreprise]>
MariaDB [entreprise]> SAVEPOINT point1;  --# point de sauvegarde
Query OK, 0 rows affected (0.00 sec)

MariaDB [entreprise]> UPDATE employes SET salaire = 1000;
Query OK, 20 rows affected (0.01 sec)
Rows matched: 20  Changed: 20  Warnings: 0

MariaDB [entreprise]> SELECT * FROM employes;
+-------------+-------------+----------+------+---------------+---------------+---------+
| id_employes | prenom      | nom      | sexe | service       | date_embauche | salaire |
+-------------+-------------+----------+------+---------------+---------------+---------+
|         350 | Jean-pierre | Laborde  | m    | direction     | 1999-12-09    |    1000 |
|         388 | Clement     | Gallet   | m    | commercial    | 2000-01-15    |    1000 |
|         415 | Thomas      | Winter   | m    | commercial    | 2000-05-03    |    1000 |
|         417 | Chloe       | Dubar    | f    | production    | 2001-09-05    |    1000 |
|         491 | Elodie      | Fellier  | f    | secretariat   | 2002-02-22    |    1000 |
|         509 | Fabrice     | Grand    | m    | comptabilite  | 2003-02-20    |    1000 |
|         547 | Melanie     | Collier  | f    | commercial    | 2004-09-08    |    1000 |
|         592 | Laura       | Blanchet | f    | direction     | 2005-06-09    |    1000 |
|         627 | Guillaume   | Miller   | m    | commercial    | 2006-07-02    |    1000 |
|         655 | Celine      | Perrin   | f    | commercial    | 2006-09-10    |    1000 |
|         699 | Julien      | Cottet   | m    | secretariat   | 2007-01-18    |    1000 |
|         701 | Mathieu     | Vignal   | m    | informatique  | 2008-12-03    |    1000 |
|         739 | Thierry     | Desprez  | m    | secretariat   | 2009-11-17    |    1000 |
|         780 | Amandine    | Thoyer   | f    | communication | 2010-01-23    |    1000 |
|         802 | Damien      | Durand   | m    | informatique  | 2010-07-05    |    1000 |
|         854 | Daniel      | Chevel   | m    | informatique  | 2011-09-28    |    1000 |
|         876 | Nathalie    | Martin   | f    | juridique     | 2012-01-12    |    1000 |
|         900 | Benoit      | Lagarde  | m    | production    | 2013-01-03    |    1000 |
|         933 | Emilie      | Sennard  | f    | commercial    | 2014-09-11    |    1000 |
|         990 | Stephanie   | Lafaye   | f    | assistant     | 2015-06-02    |    1000 |
+-------------+-------------+----------+------+---------------+---------------+---------+
20 rows in set (0.00 sec)

MariaDB [entreprise]>
MariaDB [entreprise]> SAVEPOINT point2; --# ce n est pas une sauvegarde!
Query OK, 0 rows affected (0.00 sec)

MariaDB [entreprise]> UPDATE employes SET salaire = 5000;
Query OK, 20 rows affected (0.00 sec)
Rows matched: 20  Changed: 20  Warnings: 0

MariaDB [entreprise]> SELECT * FROM employes;
+-------------+-------------+----------+------+---------------+---------------+---------+
| id_employes | prenom      | nom      | sexe | service       | date_embauche | salaire |
+-------------+-------------+----------+------+---------------+---------------+---------+
|         350 | Jean-pierre | Laborde  | m    | direction     | 1999-12-09    |    5000 |
|         388 | Clement     | Gallet   | m    | commercial    | 2000-01-15    |    5000 |
|         415 | Thomas      | Winter   | m    | commercial    | 2000-05-03    |    5000 |
|         417 | Chloe       | Dubar    | f    | production    | 2001-09-05    |    5000 |
|         491 | Elodie      | Fellier  | f    | secretariat   | 2002-02-22    |    5000 |
|         509 | Fabrice     | Grand    | m    | comptabilite  | 2003-02-20    |    5000 |
|         547 | Melanie     | Collier  | f    | commercial    | 2004-09-08    |    5000 |
|         592 | Laura       | Blanchet | f    | direction     | 2005-06-09    |    5000 |
|         627 | Guillaume   | Miller   | m    | commercial    | 2006-07-02    |    5000 |
|         655 | Celine      | Perrin   | f    | commercial    | 2006-09-10    |    5000 |
|         699 | Julien      | Cottet   | m    | secretariat   | 2007-01-18    |    5000 |
|         701 | Mathieu     | Vignal   | m    | informatique  | 2008-12-03    |    5000 |
|         739 | Thierry     | Desprez  | m    | secretariat   | 2009-11-17    |    5000 |
|         780 | Amandine    | Thoyer   | f    | communication | 2010-01-23    |    5000 |
|         802 | Damien      | Durand   | m    | informatique  | 2010-07-05    |    5000 |
|         854 | Daniel      | Chevel   | m    | informatique  | 2011-09-28    |    5000 |
|         876 | Nathalie    | Martin   | f    | juridique     | 2012-01-12    |    5000 |
|         900 | Benoit      | Lagarde  | m    | production    | 2013-01-03    |    5000 |
|         933 | Emilie      | Sennard  | f    | commercial    | 2014-09-11    |    5000 |
|         990 | Stephanie   | Lafaye   | f    | assistant     | 2015-06-02    |    5000 |
+-------------+-------------+----------+------+---------------+---------------+---------+
20 rows in set (0.00 sec)

MariaDB [entreprise]>
MariaDB [entreprise]> SAVEPOINT point3; --# ce n est pas une sauvegarde!
Query OK, 0 rows affected (0.00 sec)

MariaDB [entreprise]> DELETE FROM employes;
Query OK, 20 rows affected (0.01 sec)

MariaDB [entreprise]> SELECT * FROM employes;
Empty set (0.00 sec)

------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

ROLLBACK TO point2; --# on annule les opérations éxécutées après le point2 . Annule ce qu'il y a entre ce point et le ROLLBACK
SELECT * FROM employes;

ROLLBACK TO point3; --#  Si je veux  repasser les salaires à 5000€   il m'affiche:    ERROR 1305 (42000): SAVEPOINT point3 does not exist
/*si on veut repasser les salaires à 5000, on ne peut pas*/
SELECT * FROM employes;

ROLLBACK TO point1; --# ok car le point1 est précédent au point2. 
SELECT * FROM employes;

COMMIT; --# pour valider les opérations.



IL y a donc le 	ROLLBACK  			->  START TRANSACTION
Et				ROLLBACK TO point.. -> 	SAVEPOINT point..







