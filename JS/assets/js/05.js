/*---------------------------------------
    INCREMENTATION ET DECREMENTATION
---------------------------------------*/

// ################ ~ Incrémentation ~ ############### //

var nb1=1;
nb1 = nb1 + 1;
//écriture simplifiée
nb1++;  //raccourci de nb1 = nb1 + 1;  -> Par pas de 1




// ################ ~ Décrémentation ~ ############### //

var nb1=1;
nb1 = nb1 - 1;
//écriture simplifiée
nb1--;  //raccourci de nb1 = nb1 - 1;  -> Par pas de 1
//on est la     oui je sais


// ################ ~ Subtilité ~ ############### //

nb1=0;
console.log(nb1++); //il va d'abord afficher nb1, (soit 0), puis il va incrémenter. Du coup, il affiche 0
console.log(nb1);   //il faut redemander a afficher nb1 pour qu'il affiche 1

nb1=0;
console.log(++nb1); // les ++ devant nb1 signifient qu'il va d'abord incrémenter nb1 puis l'afficher

/** du coup, 
*  si, par exemple nb1=10,
*  nb1++ affiche 10, lorsqu'il est dans un console.log()
*  et 
*  ++nb1 affiche 11, lorsqu'il est dans un console.log()
*/

