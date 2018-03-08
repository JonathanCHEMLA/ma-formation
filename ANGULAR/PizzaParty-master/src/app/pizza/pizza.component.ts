import { Component, Input } from '@angular/core';
import {Pizza } from '../model/pizza';

@Component({
  selector: 'app-pizza',
  templateUrl: './pizza.component.html',
  styleUrls: ['./pizza.component.css']
})
export class PizzaComponent{
  @Input() pizza: Pizza; 
}
