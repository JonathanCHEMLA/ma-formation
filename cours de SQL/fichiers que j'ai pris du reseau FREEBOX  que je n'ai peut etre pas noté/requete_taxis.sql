-- Qui conduit la voiture 503
SELECT c.nom, c.prenom 
FROM conducteur c, association_vehicule_conducteur avc
WHERE avc.id_vehicule = 503 
AND c.id_conducteur = avc.id_conducteur;
+--------+----------+
| nom    | prenom   |
+--------+----------+
| Pandre | Philippe |
+--------+----------+
-- Qui conduit Quoi
SELECT c.nom, c.prenom, v.marque, v.modele 
FROM conducteur c, association_vehicule_conducteur avc, vehicule v
WHERE c.id_conducteur = avc.id_conducteur 
AND avc.id_vehicule = v.id_vehicule;
+-----------+----------+------------+--------+
| nom       | prenom   | marque     | modele |
+-----------+----------+------------+--------+
| Avigny    | Julien   | Peugeot    | 807    |
| Alamia    | Morgane  | Citroen    | C8     |
| Pandre    | Philippe | Mercedes   | Cls    |
| Pandre    | Philippe | Peugeot    | 807    |
| Blondelle | Amelie   | Volkswagen | Touran |
+-----------+----------+------------+--------+
-- Ajoutez vous dans la table conducteur
	-- Afficher tous les conducteurs (sans exception) pour ensuite rajouter les vehicules conduit si c'est le cas.
SELECT c.nom, c.prenom, v.marque, v.modele 
FROM conducteur c 
LEFT JOIN association_vehicule_conducteur avc ON c.id_conducteur = avc.id_conducteur 
LEFT JOIN vehicule v ON avc.id_vehicule = v.id_vehicule;
+-----------+----------+------------+--------+
| nom       | prenom   | marque     | modele |
+-----------+----------+------------+--------+
| Avigny    | Julien   | Peugeot    | 807    |
| Alamia    | Morgane  | Citroen    | C8     |
| Pandre    | Philippe | Mercedes   | Cls    |
| Blondelle | Amelie   | Volkswagen | Touran |
| Pandre    | Philippe | Peugeot    | 807    |
| Richy     | Alex     | NULL       | NULL   |
| Quittard  | Mathieu  | NULL       | NULL   |
+-----------+----------+------------+--------+
-- Ajoutez un nouveau vehicule
	-- Afficher tous les véhicules (sans exception) pour ensuite rajouter les conducteur si c'est le cas
SELECT c.nom, c.prenom, v.marque, v.modele 
FROM conducteur c 
RIGHT JOIN association_vehicule_conducteur avc ON c.id_conducteur = avc.id_conducteur 
RIGHT JOIN vehicule v ON avc.id_vehicule = v.id_vehicule;	
+-----------+----------+------------+---------+
| nom       | prenom   | marque     | modele  |
+-----------+----------+------------+---------+
| Avigny    | Julien   | Peugeot    | 807     |
| Pandre    | Philippe | Peugeot    | 807     |
| Alamia    | Morgane  | Citroen    | C8      |
| Pandre    | Philippe | Mercedes   | Cls     |
| Blondelle | Amelie   | Volkswagen | Touran  |
| NULL      | NULL     | Skoda      | Octavia |
| NULL      | NULL     | Volkswagen | Passat  |
+-----------+----------+------------+---------+
-- Affichez tous les conducteurs ainsi que tous les véhicules (sans exception) peu importe les correspondances.
SELECT c.nom, c.prenom, v.marque, v.modele 
FROM conducteur c 
LEFT JOIN association_vehicule_conducteur avc ON c.id_conducteur = avc.id_conducteur 
LEFT JOIN vehicule v ON avc.id_vehicule = v.id_vehicule
UNION
SELECT c.nom, c.prenom, v.marque, v.modele 
FROM conducteur c 
RIGHT JOIN association_vehicule_conducteur avc ON c.id_conducteur = avc.id_conducteur 
RIGHT JOIN vehicule v ON avc.id_vehicule = v.id_vehicule;
+-----------+----------+------------+---------+
| nom       | prenom   | marque     | modele  |
+-----------+----------+------------+---------+
| Avigny    | Julien   | Peugeot    | 807     |
| Alamia    | Morgane  | Citroen    | C8      |
| Pandre    | Philippe | Mercedes   | Cls     |
| Blondelle | Amelie   | Volkswagen | Touran  |
| Pandre    | Philippe | Peugeot    | 807     |
| Richy     | Alex     | NULL       | NULL    |
| Quittard  | Mathieu  | NULL       | NULL    |
| NULL      | NULL     | Skoda      | Octavia |
| NULL      | NULL     | Volkswagen | Passat  |
+-----------+----------+------------+---------+




	
	
	
	
	