import {Component, EventEmitter, OnInit, Output} from '@angular/core';
import {Contact} from '../shared/models/contact';

@Component({
  selector: 'app-ajouter',
  templateUrl: './ajouter.component.html',
  styleUrls: ['./ajouter.component.css']
})
export class AjouterComponent implements OnInit {

  @Output() unContactEstCree = new EventEmitter();
  nouveauContact: Contact = new Contact();
  active: boolean = true;

  constructor() { }

  ngOnInit() {
  }
//  -- Fonction appelée après le submit du formulaire
submitContact() {
  /**
   * Lorsque mon formulaire est soumis, j'émets un évenement
   * qui sera écouté par mon application ; et qui récupèrera
   * les données du nouveau contact.
   */
  this.unContactEstCree.emit({ leContact: this.nouveauContact });

  // -- Je réinitialise le nouveau contact.
  this.nouveauContact = new Contact();

  /**
   * Je passe ensuite mon formulaire à false,
   * puis immédiatement à true, ce qui a pour
   * conséquence de le détruire dans le DOM
   * puis le re-créer...
   * @type {boolean}
   */
  this.active = false;
  setTimeout(() => this.active = true, 0);
}

}
