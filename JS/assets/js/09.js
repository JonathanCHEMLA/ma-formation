/*---------------------------------------
            LES BOUCLES 🙏🏻
---------------------------------------*/


// -- La Boucle FOR

for(let i=0; i<=10 ; i++){
    document.write('<p>Instruction executée : <strong>' +i+'</strong></p>')
}

document.write('<hr>');


var j=1;
while(j<=10){
    document.write('<p>Instruction executée : <strong>' +j+'</strong></p>')

//  ATTENTION A NE PAS OUBLIER L'INCREMENTATION !
    j++;
}

document.write('<hr>');

/*-----------------------------------------
                EXERCICE
-----------------------------------------*/

// -- Supposons le tableau suivant :
var Prenoms = ['Jean','Marc','Mattieu','Luc','Pierre','Paul','Jacques', 'Hugo'];

// -- CONSIGNE : grâce à une boucle FOR, afficher la lists des prénoms 
//    du tableau ci-dessus dans la console ou sur votre page.


for(let i=0;i<Prenoms.length;i++)
{
    console.log(Prenoms[i]);
}



//CA C EST PLUS RAPIDE A AFFICHER:
// var nb=Prenoms.length;
// for(let i=0;i<nb;i++)
// {
//     console.log(Prenoms[i]);
// }




console.log('-------');


var j=0;
while(j < Prenoms.length){
    console.log(Prenoms[j]);
    j++;
}


console.log('-------');

// -- La Boucle ForEach
// -- ATTENTION A LA PERFORMANCE !!! c'est la boucle la plus lente a afficher le resultat

Prenoms.forEach(affichePrenom)

function affichePrenom(valeur, i)
{
    document.write(i + " " + valeur + "<br>");
}

