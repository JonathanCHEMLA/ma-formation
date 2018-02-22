//function l(e)
//{
//	console.log(e);
//}

l=e=> console.log(e);

l("bonjour mon ami");

/***************************************************************/

var membres = [
    {'pseudo':'Hugo','age':26,'email':'wf3@hl-media.fr','mdp':'wf3'},
    {'pseudo':'Rodrigue','age':56,'email':'rodrigue@hl-media.fr','mdp':'roro'},
    {'pseudo':'James','age':78,'email':'james@hl-media.fr','mdp':'james8862'},
    {'pseudo':'Emilio','age':18,'email':'milio@hl-media.fr','mdp':'milioDu62'}
  ];      


var Bienvenue             = document.getElementById("Bienvenue"); 
var pseudo                = document.getElementById("pseudo");
var age                   = document.getElementById("age");
var email                 = document.getElementById("email");
var mdp                   = document.getElementById("mdp");
var Submit                = document.getElementById("submit");
var InscriptionForm       = document.getElementById('InscriptionForm');

var pseudoError           = document.getElementsByClassName("pseudoError")[0];
var ageError              = document.getElementsByClassName("ageError")[0];
// [0] car il n y a qu une seule class qui porte ce nom, donc HTMLCollection...
// [0] est obligatoire sinon ca fonctionne pas.

var longueur=membres.length;
      

function controlerExistanceBdd() {

    for(let i = 0 ; i < longueur ; i++)
    {
		
		console.log(membres[i].pseudo);
		console.log(pseudo.value);
        if(membres[i].pseudo===pseudo.value) // j ai fais l'err de marquer "saisie" simplement
        {
            pseudoError.style.display="block";
            Submit.disabled = true;   //disabled signifie desactivé
            Bienvenue.textContent="";
            break;

        }
        else
        {
            pseudoError.style.display="none";
            Submit.disabled =false;
            Bienvenue.textContent="Bonjour " + pseudo.value;  // j'ai encore oublié value            
        }        
    }

}

function controlerAge() 
{  
    if(!(age.value==""))		// ! c est pas age, c est age.value
    {

		console.log(typeof parseInt(age.value));		
		if(parseInt(age.value)>= 18)
		{
			ageError.style.display="none";
			Submit.disabled=false;      // le bouton est disponible
		}
		else
		{
			ageError.style.display="block";
			Submit.disabled=true;     // le bouton est désactivé/grisé  
		}
    }
}

 function inscrireUser() 
 {
	let ok=0;
	if(pseudo.value=="")
	{
		pseudo.style.background="red";
		ok=1;
		console.log("pseudo");
	}
	if(mdp.value=="")
	{
		mdp.style.background="red";
		ok=1;
		console.log("mdp");
	}
	if(email.value=="")
	{
		email.style.background="red";
		ok=1;
		console.log("email");
	}
	if(age.value=="")
	{
		age.style.background="red";
		ok=1;
		console.log("age");
	}	
	if(ok==0)
	{
		console.log("t es rentre dans le if");
		console.log(pseudo.value);
		console.log("{'pseudo':'"+ pseudo.value +"','age':" + age.value + ",'email':'" 
		+ email.value + "','mdp':'" + mdp.value + "'}");	

        //insertion dans mon objet            
        var longueur = membres.push(
			'{pseudo: "' + pseudo.value + "', age:'" + age.value + '", email: "' + email.value + '", mdp: "' + mdp.value + '"}');
        console.log("ici j'ai mis "+ longueur);

/********les lignes ci dessous ne fonctionnent pas *********************/		
// 		membres[longueur].pseudo=pseudo.value;
//		membres[longueur].age=age.value;
//		membres[longueur].email=email.value;
//		membres[longueur].mdp=mdp.value;
 
	// Affichage
		document.write("Merci " + pseudo.value + " ! <br> Tu es maintenant inscrit.");
		
		document.write('<ul>');
		for(i=0;i<longueur;i++)
		{
			
			document.write('<li>');
				document.write("ici ma "+"Pseudo:'" + membres[i].pseudo + "', Age:'" + membres[i].age + ", Mdp:" +membres[i].mdp + ", Email:" +membres[i].email);
			document.write('</li>');
		}
		document.write('</ul>');			
		
		console.log(membres);
	}


}

pseudo.addEventListener('keyup',controlerExistanceBdd);	// ATTENTION A NE PAS METTRE LES () A LA FONCTION APPELLEE
// marche aussi bien avec l'evenement "input" ou l'evenement "keyup"

age.addEventListener("change",controlerAge);			// ATTENTION A NE PAS METTRE LES () A LA FONCTION APPELLEE

mdp.addEventListener("click",inscrireUser);		// ATTENTION A NE PAS METTRE LES () A LA FONCTION APPELLEE
//InscriptionForm.addEventListener("submit",inscrireUser);		// ATTENTION A NE PAS METTRE LES () A LA FONCTION APPELLEE