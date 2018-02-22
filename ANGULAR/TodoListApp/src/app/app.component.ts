import {Component, OnInit} from '@angular/core';
import {Task} from './models/task';
import {TaskStorageService} from './services/task-storage.service';
import * as _ from 'lodash';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent implements OnInit {

  constructor(private taskStorageService: TaskStorageService) { }

  /**
   * On déclare notre tableau de tâches.
   * @type {Task[]}
   */
  tasks: Task[] = [];

  ngOnInit(): void {
    /**
     * Au chargement de l'application, je récupère
     * mes tâches dans le localStorage.
     * @type {any}
     */
    this.tasks = this.taskStorageService.getTasks();
  }

  /**
   * Cette fonction se déclenche dans l'application
   * lorsqu'une nouvelle tâche est créée par l'utilisateur
   * dans le composant app-addTask.
   * @param newTaskEvent
   */
  newTask(newTaskEvent) {
    /**
     * On ajoute la nouvelle tâche dans le tableau de tache.
     * Et on sauvegarde toutes les tâches dans le localStorage.
     */
    this.tasks.push(newTaskEvent.task);
    this.taskStorageService.save(this.tasks);
  }

  /**
   * L'utilisateur viens de terminer une tâche.
   * @param {Task} task
   */
  taskIsDone(task: Task) {
    /**
     * Je passe la tâche de l'utilisateur à true.
     * Puis je sauvegarde toutes les tâches.
     */
    task.status = true;
    this.taskStorageService.save(this.tasks);
  }

  /**
   * L'utilisateur viens de supprimer une tâche.
   * On le retire du tableau et on sauvegarde
   * @param {Task} task
   */
  removeTask(task: Task) {
    console.log(task);
    _.pullAllWith(this.tasks, [task], _.isEqual);
    this.taskStorageService.save(this.tasks);
  }

  /**
   * Permet de compter les tâches non terminée.
   */
  getNbDoneTasks() {
    const doneTasks = _.filter(this.tasks, { 'status': false });
    return doneTasks.length;
  }

}
