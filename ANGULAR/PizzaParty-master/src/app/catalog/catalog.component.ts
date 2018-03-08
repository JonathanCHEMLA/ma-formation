import { Component, OnInit } from '@angular/core';
import { Pizza } from '../model/pizza';
import { PizzaService } from '../services/pizza.service';


@Component({
  selector: 'app-catalog',
  templateUrl: './catalog.component.html',
  styleUrls: ['./catalog.component.css'],
  providers: [PizzaService]
})
export class CatalogComponent {
  pizzas: Pizza[];
  selectedPizza: Pizza;
  total = 0;

constructor(private pizzaService: PizzaService) { 
  this.pizzaService.getPizzas().then(Pizza => this.pizzas = Pizza);
}

  onSelect (pizza){
    this.selectedPizza = pizza;
  }

  toto (event) {
    this.total += event;
  }
}