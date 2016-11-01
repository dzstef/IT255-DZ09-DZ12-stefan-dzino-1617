import { Component, Directive } from 'angular2/core';
import {Component, FormBuilder, Validators, ControlGroup, Control, FORM_DIRECTIVES, FORM_BINDINGS} from 'angular2/common'
import {Http, HTTP_PROVIDERS, Headers} from 'angular2/http';
import 'rxjs/Rx';
import {SearchPipe} from 'app/pipe/search';
import {PretragaKrevetPipe} from 'app/pipe/pretragaKrevet';
import {Router, ROUTER_PROVIDERS} from 'angular2/router'

@Component({ 
  selector: 'MainPage', 
  templateUrl: 'app/mainpage/mainpage.html',
  pipes: [SearchPipe, PretragaKrevetPipe],
  directives: [FORM_DIRECTIVES],
  viewBindings: [FORM_BINDINGS]
})

export class MainPageComponent { 
  naziv:String = "";
  krevet:String = "";
  loginForm: ControlGroup;
  http: Http;
  router: Router;
  postResponse: String;
  sobe: Object[];
	constructor(builder: FormBuilder, http: Http,  router: Router) {
	this.http = http;
	this.router = router;
	var headers = new Headers();
	headers.append('Content-Type', 'application/x-www-form-urlencoded');
	headers.append('token', localStorage.getItem('token'));
	http.get('http://localhost/php/pretrazisobe.php',{headers:headers})
		.map(res => res.json()).share()
		.subscribe(sobe => {
			this.sobe = sobe.sobe; 			
		},
		err => {
			 this.router.parent.navigate(['./AboutUs']);
		}
		);
  }
}