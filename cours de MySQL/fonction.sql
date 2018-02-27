--# FONCTIONS PREDEFINIES
--# Insrite dans le langage, le développeur ne fait que l'éxécuter.

SELECT DATABASE();	--# la BDD actuellement utilisée
SELECT VERSION();	--# affiche la version mysql

USE bibliotheque;
INSERT INTO abonne (prenom) VALUE ('test');
SELECT LAST_INSERT_ID(); --# retourne le dernier id (clé primaire) entré dans ma table




--# DATE ADD ou ADDDATE (pour les jours ADDDATE) afin de rajouter une intervalle et d'obtenir la date correspondante.


SELECT DATE_ADD('2018-02-15', INTERVAL 31 DAY); --# Affiche la date que nous serons dans 31 jours plus tard que le 15 fevrier 2018:
+-----------------------------------------+
| 2018-03-18                              |
+-----------------------------------------+

SELECT DATE_ADD(CURDATE(), INTERVAL 31 YEAR);
SELECT DATE_ADD(CURDATE(), INTERVAL 31 MONTH);
SELECT DATE_ADD(CURDATE(), INTERVAL -31 WEEK); --# on enlève 
SELECT ADDDATE(CURDATE(), 31); --# rajoute des jours à la date actuelle

SELECT CURDATE(); --# renvoie la date du jour

+------------+
| curdate()  |
+------------+
| 2018-02-15 |
+------------+

SELECT CURTIME(); --# l'heure au format francais:
+-----------+
| CURTIME() |
+-----------+
| 17:00:16  |
+-----------+
--# l'heure est affichée au format HH:MM:SS

SELECT NOW(); --# Affiche ET la date, ET l'heure (à laquelle l'article a été publié par exemple
+---------------------+
| now()               |
+---------------------+
| 2018-02-15 17:02:07 |
+---------------------+

--# Formatage des dates:
--# DATE_FORMAT() prend 2 arguments 1er: la date concernée, le 2eme le format souhaité. Utilisation de "Token"
SELECT date_format('2018-02-15 17:07:40' , '%d/%m/%Y à %H:%i:%s');
+------------------------------------------------------------+
| date_format('2018-02-15 17:07:40' , '%d/%m/%Y à %H:%i:%s') |
+------------------------------------------------------------+
| 15/02/2018 à 17:07:40                                      |
+------------------------------------------------------------+


https://dev.mysql.com/doc/refman/5.5/en/date-and-time-functions.html
-----------------------------------------------------------------------------------------------------------------------#
Specifier	Description
%a	Abbreviated weekday name (Sun..Sat)
%b	Abbreviated month name (Jan..Dec)
%c	Month, numeric (0..12)
%D	Day of the month with English suffix (0th, 1st, 2nd, 3rd, …)
%d	Day of the month, numeric (00..31)
%e	Day of the month, numeric (0..31)
%f	Microseconds (000000..999999)
%H	Hour (00..23)
%h	Hour (01..12)
%I	Hour (01..12)
%i	Minutes, numeric (00..59)
%j	Day of year (001..366)
%k	Hour (0..23)
%l	Hour (1..12)
%M	Month name (January..December)
%m	Month, numeric (00..12)
%p	AM or PM
%r	Time, 12-hour (hh:mm:ss followed by AM or PM)
%S	Seconds (00..59)
%s	Seconds (00..59)
%T	Time, 24-hour (hh:mm:ss)
%U	Week (00..53), where Sunday is the first day of the week; WEEK() mode 0
%u	Week (00..53), where Monday is the first day of the week; WEEK() mode 1
%V	Week (01..53), where Sunday is the first day of the week; WEEK() mode 2; used with %X
%v	Week (01..53), where Monday is the first day of the week; WEEK() mode 3; used with %x
%W	Weekday name (Sunday..Saturday)
%w	Day of the week (0=Sunday..6=Saturday)
%X	Year for the week where Sunday is the first day of the week, numeric, four digits; used with %V
%x	Year for the week, where Monday is the first day of the week, numeric, four digits; used with %v
%Y	Year, numeric, four digits
%y	Year, numeric (two digits)
%%	A literal % character
%x	x, for any “x” not listed above
------------------------------------------------------------------------------------------------------------------------#


SELECT DATE_FORMAT(CURTIME(), '%H:%i:%s');
+------------------------------------+
| DATE_FORMAT(CURTIME(), '%H:%i:%s') |
+------------------------------------+
| 17:17:07                           |
+------------------------------------+
SELECT DATE_FORMAT(date_sortie, '%d/%m/%Y') AS 'Date fr' FROM emprunt;
+------------+
| Date fr    |
+------------+
| 17/12/2014 |
| 18/12/2014 |
| 19/12/2014 |
| 19/12/2014 |
| 19/12/2014 |
| 20/03/2015 |
| 13/06/2015 |
| 15/06/2015 |
+------------+

--# %d est un token (jeton de remplacement) permettant d'afficher l'information correspondante lors de l'éxécution de la fonction.
--# %Y en majuscule pour avoir l'année en 4 chiffres
--# %H en majuscule pour avoir l'heure sur 24 (%h pour l'avoir sur 12)

SELECT DAYNAME('1984-01-15'); /*affiche notr jour de naissance en fournissant la date au format anglais*/ 

--#
select password("mon mot de passe");
+-------------------------------------------+
| password("mon mot de passe")              |
+-------------------------------------------+
| *DA793D3BC059685BB32D33B01DF458DD43CBE127 |
+-------------------------------------------+

/*s'il veut se connecter, on recrypte son mdp envoye. si on obtient les memes infos,  (*DA793D3BC059685BB32D33B01DF458DD43CBE127 ) c'est bon, on le connecte*/

--# on peut faire des calculs avec sql(attention, pas les float):
select 1+1;
select 2323232+1212121;
+-----------------+
| 2323232+1212121 |
+-----------------+
|         3535353 |
+-----------------+

--# Concaténation ("affiche moi cette information SUIVIE DE cette information SUIVIE DE cette information SUIVIE DE..." )
SELECT CONCAT("a","b","c"); /* en js c'est le +  en php c'est le .  et en sql c'est la fonction CONCAT( , , , , , ) */

select Concat_ws("-","a","b","c");
+----------------------------+
| Concat_ws("-","a","b","c") |
+----------------------------+
| a-b-c                      |
+----------------------------+

use bibliotheque;
select concat_ws("-",auteur,titre) as "les livres" FROM livre;
+-----------------------------------------+
| les livres                              |
+-----------------------------------------+
| GUY DE MAUPASSANT-Une vie               |
| GUY DE MAUPASSANT-Bel-Ami               |
| HONORE DE BALZAC-Le père Goriot         |
| ALPHONSE DAUDET-Le Petit chose          |
| ALEXANDRE DUMAS-La Reine Margot         |
| ALEXANDRE DUMAS-Les Trois Mousquetaires |
+-----------------------------------------+

--# compter le nbre de caractères.
select LENGTH("abc"); --# permet de compter le nbre de caractères dans la chaine fournie en argument.

SELECT UPPER("bonjour"); /*c'est tres utile car sql n est pas sensible a la casse. aussi si on veut stocker l'information en maj par ex c'est important de passer par un UPPER()*/
SELECT LOWER("Bonjour");

select trim('       Bonjour à tous             '); --# retourne la chaine sans les espace à droite et à gauche. Conseil: passer la saisie de l'user SYSTEMATIQUEMENT dans les TRIM() !  






---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------





--# Formatage des dates:
--# DATE_FORMAT() prend 2 arguments: 1er: la date concernée, 2ème le format souhaité
SELECT date_format('2018-02-15 17:07:40', '%d/%m/%Y à %H:%i:%s');
SELECT date_format(CURTIME(), '%H:%i:%s');
SELECT DATE_FORMAT(date_sortie, '%d/%m/%Y') AS 'Date fr' FROM emprunt;

SELECT date_format("2018-02-16 11:26:10", "%Hh %imin %ss");
+-----------------------------------------------------+
| date_format("2018-02-16 11:26:10", "%Hh %imin %ss") |
+-----------------------------------------------------+
| 11h 26min 10s                                       |
+-----------------------------------------------------+
1 row in set (0.00 sec)

SELECT CONCAT( date_format("2018-02-16 11:26:10", "%H"), "h");
+--------------------------------------------------------+
| CONCAT( date_format("2018-02-16 11:26:10", "%H"), "h") |
+--------------------------------------------------------+
| 11h                                                    |
+--------------------------------------------------------+

