import { Injectable } from '@angular/core';

@Injectable()
export class PizzaService{
    getPizzas() {
        return Promise.resolve( [
            {id: 1, name: 'La Tartiflette', price: 12  , image:'assets/image/reine.jpg'},
            {id: 2, name: 'La Reine', price: 13 , image:'assets/image/orientale.jpg'},
            {id: 3, name: 'L\' Orientale', price: 13 , image:'assets/image/fromage.jpg'},
            {id: 4, name: 'La Forestière', price: 12 , image:'assets/image/cannibale.jpg'},
          ]);
    }
    
}
