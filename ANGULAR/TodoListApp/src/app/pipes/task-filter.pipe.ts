import { Pipe, PipeTransform } from '@angular/core';
import {Task} from '../models/task';
import * as _ from 'lodash';


// : https://stackoverflow.com/questions/34456430/ngfor-doesnt-update-data-with-pipe-in-angular2
@Pipe({
  name: 'taskFilter',
  pure: false
})
export class TaskFilterPipe implements PipeTransform {

  transform(tasks: Task[], status: boolean): Task[] {
    if (status) {
      // -- Retourne les tâches terminées
      return _.filter(tasks, { 'status': true });
    } else {
      // -- Retourne les tâches non terminées
      return _.filter(tasks, { 'status': false });
    }
  }

}
