
import { Component } from '@angular/core';



@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  /*template: `<h1>{{title}}</h1>
            <h2>{{name}}</h2>
            <h2>{{regina.name}}</h2>
            <p>{{regina.price}}</p>
            <input [(ngModel)]="regina.name" placeholder="Le nom de la pizza">
            
            <li *ngFor="let pizza of pizzas">{{pizza.name}}</li>
            `,*/
  styleUrls: ['./app.component.css']
 
  
})
export class AppComponent {
    title = 'Welcome to Koto Pizz\'3';
    

  changeTitle () {
    this.title = 'Clic sur la pizza';
  }
}

