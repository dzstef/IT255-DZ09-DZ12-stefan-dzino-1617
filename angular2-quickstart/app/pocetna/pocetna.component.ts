import { Component, Directive } from 'angular2/core';
import {Http, HTTP_PROVIDERS} from 'angular2/http';
import {SearchPipe} from 'app/pipe/search';
import 'rxjs/Rx';

@Component({ 
  selector: 'Pocetna', 
  templateUrl: 'app/pocetna/pocetna.html'
})

export class PocetnaComponent{
}