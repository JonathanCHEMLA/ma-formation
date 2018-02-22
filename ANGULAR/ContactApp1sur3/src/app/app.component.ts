/**
 * Pour déclarer une classe comme composant de
 * notre application, on importe "Component"
 * via @angular/core
 */
import { Component } from '@angular/core';
import { Contact } from './shared/models/contact';

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
export class AppComponent {

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

  mesContacts: Contact[] = [
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
  ];

  /**
   * Ma fonction choisir contact, prend un contact
   * en paramètre et le transmet a la variable contactActif
   * @param contactCliqueParMonUtilisateur
   */
  choisirContact(contactCliqueParMonUtilisateur) {
    this.contactActif = contactCliqueParMonUtilisateur;
    console.log(this.contactActif);
  }

}
