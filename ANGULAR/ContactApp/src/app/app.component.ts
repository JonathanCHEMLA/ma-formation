/**
 * Pour déclarer une classe comme composant de
 * notre application, on importe "Component"
 * via @angular/core
 */
import {Component, OnInit} from '@angular/core';
import { Contact } from './shared/models/contact';
import {UserApiService} from './shared/services/user-api.service';
import {UserStorageService} from './shared/services/user-storage.service';

/**
 * @Component est ce qu'on appelle un décorateur.
 * Il va nous permettre de définir 3 paramètres
 * essentiels à notre application...
 */
@Component({
  /**
   * Le sélecteur (selector) détermine la manière donr
   * le composant sera affiché dans votre HTML.
   * On écrira dans notre HTML : <app-root></app-root>
   * vous devez OBLIGATOIREMENT avoir la balise d'ouverture
   * et de fermeture.
   */
  selector: 'app-root',
  /**
   * "templateUrl" ou "template" est la partie visible
   * du composant. C'est ce qui s'affiche à l'écran
   * lorsque le composant est utilisé.
   */
  templateUrl: './app.component.html',
  // template: `
  //   <h1>Hello Arnaud !</h1>
  // `,
  /**
   * La déclaration des styles avec "styleUrls" ou "styles"
   */
  styleUrls: ['./app.component.css']
})
/**
 * La classe contient les données du composant, mais aussi
 * son comportement. Dans le contexte MV VM, notre classe
 * correspond au ViewModel.
 */
export class AppComponent implements OnInit {

  constructor(private userApiService: UserApiService,
              private userStorageService: UserStorageService) {}

  // -- Déclaration d'une Variable Titre
  title: string = 'Gestion de mes Contacts';

  // -- Contact choisi par mon utilisateur.
  contactActif: Contact;

  // -- Déclaration d'un Object Contact
  unContact: Contact = {
    id        : 1,
    name      : 'Hugo LIEGEARD',
    username  : 'hugoliegeard',
    email     : 'wf3@hl-media.fr'
  };

  mesContacts: Contact[] = [];
/*  mesContacts: Contact[] = [
    {
      id        : 1,
      name      : 'Hugo LIEGEARD',
      username  : 'hugoliegeard',
      email     : 'wf3@hl-media.fr'
    },
    {
      id        : 2,
      name      : 'Arnaud VALLETTE',
      username  : 'arnaudvallette',
      email     : 'a.vallette@hl-media.fr'
    },
    {
      id        : 3,
      name      : 'Jonathan CHEMLA',
      username  : 'jonathanchemla',
      email     : 'j.chemla@hl-media.fr'
    }
  ];*/

  ngOnInit(): void {
    /*this.userApiService.getContacts().subscribe(
      contacts => {
        // console.log(contacts);
        this.mesContacts = contacts;
      }
    );*/
    // this.userStorageService.getContacts().subscribe(
    //   contacts => {
    //     this.mesContacts = contacts;
    //   }
    // );
    this.mesContacts = this.userStorageService.getContacts();
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
    const leContact: Contact = event.leContact;
    let id: number = this.mesContacts.length;
    leContact.id = id += 1;
    this.mesContacts.push(leContact);
    this.userStorageService.save(this.mesContacts);
  }

  saveContact() {
    this.userStorageService.save(this.mesContacts);
  }

}
