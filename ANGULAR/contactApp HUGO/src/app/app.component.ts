/**
 * Pour déclarer une classe comme composant de
 * notre application, on importe "Component"
 * via @angular/core
 */
import { Component } from '@angular/core';

/**
 * Création d'une Interface Contact.
 * Cela me permet de définir la forme/structure
 * de mes objets contact.
 * Ainsi, je m'assure que mes contacts soient des "contact"
 */

interface Contact {
  id      : number;
  prenom  : string;
  nom     : string;
  email?   : string;
}

interface ContactArray {
  [index: number] : Contact;
}

/**
 * @Component est ce qu'on appelle un décorateur.
 * Il va nous permettre de définir 3 paramètres essentiels
 * à notre application...
 */
@Component({
  /**
   * Le sélecteur (selector) détermine la manière dont
   * le composant sera affiché dans un template.
   * On écrira dans notre HTML : <app-root></app-root>
   * Vous devez OBLIGATOIREMENT avoir la balise d'ouverture
   * et la balise de fermeture.
   */
  selector: 'app-root',
  /**
   * "templateUrl" ou "template est la partie visible
   * du composant. C'est ce qui s'affiche à l'écran
   * lorsque le composant est utilisé.
   */
  templateUrl: './app.component.html',
  /**
   * La déclaration des styles avec "styleUrls" ou "styles"
   */
  styleUrls: ['./app.component.css']
})
/**
 * La classe contient les données du composant, mais aussi
 * son comportement.
 * Dans le contexte MVVM, notre classe correspond au ViewModel.
 */
export class AppComponent {
  // -- Déclaration d'une variable title
  title = 'ContactApp';

  // -- Déclaration d'un Objet Contact
  contact:Contact = {
    id      : 1,
    prenom  : "Hugo",
    nom     : "LIEGEARD"
  }

  // -- Un Tableau qui contient une collection de contacts
  contacts:Contact[] = [
    {id: 1, prenom:"Hugo", nom:"LIEGEARD", email: "wf3@hl-media.fr"},
    {id: 2, prenom:"Rodrigue", nom:"NOUEL"},
    {id: 3, prenom:"Kristie", nom:"SOUKAI"},
  ]

  /**
   * Une fonction qui retourne le nom complet d'un contact
   * @param {Contact} UnContact
   * @returns {string}
   */
    // function getNomComplet(UnContact:Contact) { }
  getNomComplet = (UnContact:Contact) => {
    return UnContact.prenom + ' ' + UnContact.nom;
  }

  // -- Choix de mon utilisateur actif
  contactActif:Contact;

  /**
   * Permet de définir un contact actif
   * @param {Contact} UnContact
   */
  choisirUnContact = (UnContact) => {
    console.log(this);
    this.contactActif = UnContact;
    //console.log(this.contactActif);
  }


}
