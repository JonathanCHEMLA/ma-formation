import {Component, EventEmitter, OnInit, Output} from '@angular/core';
import {Task} from '../models/task';

@Component({
  selector: 'app-addtask',
  templateUrl: './addtask.component.html',
  styleUrls: ['./addtask.component.css']
})
export class AddtaskComponent implements OnInit {

  /**
   * Permet d'emettre un évènement lors de la
   * création d'une nouvelle tâche.
   * @type {EventEmitter<any>}
   */
  @Output() newTaskEvent = new EventEmitter();

  /**
   * La tâche à créer
   * @type {Task}
   */
  task: Task = new Task();

  /**
   * Permet de réinitialiser le formulaire.
   * @type {boolean}
   */
  active: boolean = true;

  constructor() { }

  ngOnInit() {
  }

  /**
   * Fonction appelée lors de la création d'une tâche.
   */
  addTask() {
    /**
     * Lorsque l'utilisateur soumet sa tâche,
     * J'emets l'évènement avec la nouvelle tâche.
     */
    this.newTaskEvent.emit({task: this.task});
    this.task = new Task();
    /**
     * On réinitialise le formulaire
     */
    this.active = false;
    setTimeout(() => this.active = true, 0);
  }

}
