import {Component, EventEmitter, OnInit, Output} from '@angular/core';
import {Contact} from '../shared/models/contact';

@Component({
  selector: 'app-ajouter',
  templateUrl: './ajouter.component.html',
  styleUrls: ['./ajouter.component.css']
})
export class AjouterComponent implements OnInit {

  @Output () unContactEstCree = new EventEmitter();
  nouveauContact: Contact = new Contact();
  active: boolean = true;

  constructor() { }

  ngOnInit() {
  }

  // -- Fonction appelé après le submit du formulaire
  submitContact () {
    /** -- Lorsque mon formulaire est soumis, j'emets un évenement qui sera
     *écouté par mon application et qui récuperera les données du nouveau contact.
     */
    this.unContactEstCree.emit( { leContact: this.nouveauContact});
    // -- je Reinitialise le nouveau contact.
    this.nouveauContact = new Contact();

    /**
     * je passe ensuite mon formulaire a false puis immediatement a true ce qui a pour consequence de le detruire dans le DOM puis le recreer.
     * @type {boolean}
     */
    this.active = false;
    setTimeout(() => this.active = true,  0);

  }

}
