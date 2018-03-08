import { Component } from '@angular/core';
import { Contact } from '../shared/models/contact';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent {
  title: string = 'Gestion de mes contacts2';

  contactActif: Contact;

  unContact: Contact = {
    id        : 1,
    name      : 'Adeline Clere',
    username  : 'a2L',
    email     : 'wf3@hl-media.fr'
  };

  mesContacts: Contact[] = [
    {
    id        : 1,
    name      : 'Adeline Clere',
    username  : 'a2L',
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

    choisirContact(contactCliqueParMonUtilisateur) {
      this.contactActif = contactCliqueParMonUtilisateur;
      console.log(this.contactActif);
    }

}
