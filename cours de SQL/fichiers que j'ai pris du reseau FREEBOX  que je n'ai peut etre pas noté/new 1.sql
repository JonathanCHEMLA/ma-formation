-- qui conduit la voiture 503 imbriq et jointure
SELECT prenom
FROM conducteur 
WHERE id_conducteur IN (SELECT id_conducteur FROM association_vehicule_conducteur WHERE id_vehicule = '503'); -- pas obligé les guillements

SELECT nom, prenom
FROM conducteur c, association_vehicule_conducteur avc
WHERE avc.id_vehicule = 503
AND c.id_conducteur = avc.id_conducteur;

-- qui conduit quoi

SELECT prenom.c, nom.c, marque.v, modele.v
FROM conducteur c , association_vehicule_conducteur avc, vehicule v
WHERE c.id_conducteur = avc.id_conducteur
AND avc.id_vehicule = v.id_vehicule;



-- ajoutez vous dans la table conducteur
	-- afficher tous les conducteurs (sans exception) pour ensuite rajouter les vehicules conduit si c'est le cas

SELECT prenom.c, nom.c, marque.v, modele.v
FROM conducteur c 
LEFT JOIN association_vehicule_conducteur avc ON c.id_conducteur = avc.id_conducteur
LEFT JOIN vehicule c ON avec.id_vehicule= v.id_vehicule;

-- ajoutez un nouveau vehicule
	-- afficher tous les vehicules (sans exception) pour ensuite rajouter les conducteurs si c'est le cas

SELECT prenom.c, nom.c, marque.v, modele.v
FROM conducteur c 
RIGHT JOIN association_vehicule_conducteur avc ON c.id_conducteur = avc.id_conducteur
RIGHT JOIN vehicule c ON avec.id_vehicule= v.id_vehicule;




-- afficher tous les conducteurs ainsi que tous les vehicules  (sans exception) peu importe les correspondances

SELECT prenom.c, nom.c, marque.v, modele.v
FROM conducteur c 
LEFT JOIN association_vehicule_conducteur avc ON c.id_conducteur = avc.id_conducteur
LEFT JOIN vehicule c ON avec.id_vehicule= v.id_vehicule;
UNION
SELECT prenom.c, nom.c, marque.v, modele.v
FROM conducteur c 
RIGHT JOIN association_vehicule_conducteur avc ON c.id_conducteur = avc.id_conducteur
RIGHT JOIN vehicule c ON avec.id_vehicule= v.id_vehicule;



