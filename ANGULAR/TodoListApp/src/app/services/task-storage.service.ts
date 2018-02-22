import { Injectable } from '@angular/core';

@Injectable()
export class TaskStorageService {

  constructor() { }

// -- Récupérer la liste des tâches
getTasks() {
  /**
   * Avant de retourner les données, je m'assure
   * qu'il y a bien des données dans le localStorage.
   * S'il n'y a pas de donnée, je retourne un tableau vide.
   * @type {any}
   */
  const tasks = JSON.parse(localStorage.getItem('tasks'));
    if (tasks != null) {
      return tasks;
    } else {
      return [];
    }
}

//  -- Sauvegarder les tâches
save(tasks) {
    localStorage.setItem('tasks', JSON.stringify(tasks));
}

}
