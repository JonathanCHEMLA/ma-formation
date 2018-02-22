import { Injectable } from '@angular/core';
import {AsyncLocalStorage} from 'angular-async-local-storage';

@Injectable()
export class UserStorageService {

  constructor(private storage: AsyncLocalStorage) { }

  getContacts() {
    // return this.storage.getItem('contacts');
    return JSON.parse(localStorage.getItem('contacts'));
  }

  save(contacts) {
    // this.storage.setItem('contacts', contacts).subscribe(() => { console.log('saved'); }, () => { });
    localStorage.setItem('contacts', JSON.stringify(contacts));
  }

}
