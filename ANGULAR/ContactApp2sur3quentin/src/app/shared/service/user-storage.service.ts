import { Injectable } from '@angular/core';
import {AsyncLocalStorage} from 'angular-async-local-storage';

@Injectable()
export class UserStorageService {

  constructor(private storage: AsyncLocalStorage) { }

  getContact() {
    return this.storage.getItem('constacts');
  }
  save(contacts) {
    this.storage.setItem('contacts', contacts).subscribe(() => { }, e => { });
    // localStorage.setItem('contacts', JSON.stringify(contacts));
  }

}
