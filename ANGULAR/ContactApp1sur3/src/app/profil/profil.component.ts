import {Component, EventEmitter, Input, OnInit, Output} from '@angular/core';
import {Contact} from '../shared/models/contact';
import {UserStorageService} from '../shared/services/user-storage.service';

@Component({
  selector: 'app-profil',
  templateUrl: './profil.component.html',
  styleUrls: ['./profil.component.css']
})
export class ProfilComponent implements OnInit {

  @Input() contact: Contact;
  @Output() userhasbeenchanged = new EventEmitter();

  constructor() { }
  ngOnInit() {
  }

  userHasBeenChanged() {
    this.userhasbeenchanged.emit();
  }
}
