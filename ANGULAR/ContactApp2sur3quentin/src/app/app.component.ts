/**
* Pour déclarer une class comme composant de
* notre application, on importe " Component " via @angular/core
*/
import {Component, OnInit} from '@angular/core';
import { Contact } from './shared/models/contact';
import {UserApiService} from './shared/service/user-api.service';
import {UserStorageService} from './shared/service/user-storage.service';


/**
 * @Component est ce que l'on appelle un décorateur,
 * il va nous permettre de definir 3 parametres essentiels
 * a notre application...
 */
@Component({
  /**
   * Le selecteur (selector) determine la meniere dont le composant
   * sera afficher dans votre HTML.
   * on ecrira dans notre HTML : <app-root></app-root>
   * vous devez OBLIGATOIREMENT avoir la balise d'ouverture et de
   * fermeture.
   */
  selector: 'app-root',
  /**
   * "templateUrl" ou "template" est la partie visible du composant.
   * C'est ce qui s'affiche a l'cran lorsque le composant est utilisé.
   */
  templateUrl: './app.component.html',
  /**
   * La déclaration des styles se fait avec "styleUrls" ou "styles"
   */
  styleUrls: ['./app.component.css']
})

/**
 * La classe contient les données du composant mais aussi sont comportement.
 * Dans le contexte MV - VM notre classe correspond au ViewModel.
 */
export class AppComponent implements OnInit {


  constructor (private userApiService: UserApiService,
               private userStorageService: UserStorageService) {}



  // -- Déclaration d'une variable Titre
  title: string = 'Gestion de mes Contacts';

  // -- Contact choisi par mon utilisateur
  contactActif: Contact;

  // -- Déclaration d'un Objet Contacts
  unContact: Contact = {
    id        : 1,
    name      : 'Quentin Chateaureynaud',
    username  : 'QuentinChateau',
    email     : 'quentin78480@yahoo.fr'
  };

  mesContacts: Contact [] = [
    {
      id        : 1,
      name      : 'Quentin Chateaureynaud',
      username  : 'QuentinChateau',
      email     : 'quentin78480@yahoo.fr'
    },
    {
      id        : 2,
      name      : 'Arnaud VALLETTE',
      username  : 'Arnaudvalette',
      email     : 'a.vallette@hl-media.fr'
    },
    {
      id        : 3,
      name      : 'Jonathan CHEMLA',
      username  : 'JonathanChemla',
      email     : 'j.chemla@hl-media.fr'
    }
  ];

  ngOnInit(): void {
    this.userApiService.getContact().subscribe(
       contacts => {
          console.log(contacts);
          this.mesContacts = contacts;
       }
    );
  }

  /**
   * Ma fonction choisir contact, prend un contact
   * en paramètre et le transmet a la variable contactActif
   * @param contactCliqueParMonUtilisateur
   */

  choisirContact(contactCliqueParMonUtilisateur) {
    this.contactActif = contactCliqueParMonUtilisateur;
    console.log(this.contactActif);
  }
  ajouterContactDansListe(event) {
    const leContact = event.leContact;
    let id : number = this.mesContacts.length;
    leContact.id = id += 1;
    this.mesContacts.push(leContact);
    this.userStorageService.save(this.mesContacts);
  }
}


































