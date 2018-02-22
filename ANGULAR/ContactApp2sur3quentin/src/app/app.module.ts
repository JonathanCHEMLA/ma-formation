import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';


import { AppComponent } from './app.component';
import {FormsModule} from '@angular/forms';
import { ProfilComponent } from './profil/profil.component';
import { AjouterComponent } from './ajouter/ajouter.component';
import {HttpClientModule} from '@angular/common/http';
import {UserApiService} from './shared/service/user-api.service';
import {UserStorageService} from './shared/service/user-storage.service';
import {AsyncLocalStorageModule} from 'angular-async-local-storage';


@NgModule({
  declarations: [
    AppComponent,
    ProfilComponent,
    AjouterComponent
  ],
  imports: [
    BrowserModule,
    FormsModule,
    HttpClientModule,
    AsyncLocalStorageModule
  ],
  providers: [
    UserApiService,
    UserStorageService
  ],
  bootstrap: [AppComponent]
})
export class AppModule { }
