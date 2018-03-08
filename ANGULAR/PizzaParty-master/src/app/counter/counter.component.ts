import { Component, EventEmitter, Output } from '@angular/core';

@Component({
  selector: 'app-counter',
  templateUrl: './counter.component.html',
  styleUrls: ['./counter.component.css']
})
export class CounterComponent {
  count = 0 ;
  @Output() augmente = new EventEmitter();
  @Output() diminue = new EventEmitter();

up (){
    this.count = this.count+1;
    this.augmente.emit(1);
};

down (){
  if (this.count <=0){
    this.count = 0;
    
  }else{
  this.count = this.count-1;
  this.diminue.emit(-1);
}};
}


