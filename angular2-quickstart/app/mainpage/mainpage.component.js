System.register(['angular2/core', 'angular2/common', 'angular2/http', 'rxjs/Rx', 'app/pipe/search', 'app/pipe/pretragaKrevet', 'angular2/router'], function(exports_1, context_1) {
    "use strict";
    var __moduleName = context_1 && context_1.id;
    var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
        var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
        if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
        else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
        return c > 3 && r && Object.defineProperty(target, key, r), r;
    };
    var __metadata = (this && this.__metadata) || function (k, v) {
        if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
    };
    var core_1, common_1, http_1, search_1, pretragaKrevet_1, router_1;
    var MainPageComponent;
    return {
        setters:[
            function (core_1_1) {
                core_1 = core_1_1;
            },
            function (common_1_1) {
                common_1 = common_1_1;
            },
            function (http_1_1) {
                http_1 = http_1_1;
            },
            function (_1) {},
            function (search_1_1) {
                search_1 = search_1_1;
            },
            function (pretragaKrevet_1_1) {
                pretragaKrevet_1 = pretragaKrevet_1_1;
            },
            function (router_1_1) {
                router_1 = router_1_1;
            }],
        execute: function() {
            MainPageComponent = (function () {
                function MainPageComponent(builder, http, router) {
                    var _this = this;
                    this.naziv = "";
                    this.krevet = "";
                    this.http = http;
                    this.router = router;
                    var headers = new http_1.Headers();
                    headers.append('Content-Type', 'application/x-www-form-urlencoded');
                    headers.append('token', localStorage.getItem('token'));
                    http.get('http://localhost/php/pretrazisobe.php', { headers: headers })
                        .map(function (res) { return res.json(); }).share()
                        .subscribe(function (sobe) {
                        _this.sobe = sobe.sobe;
                    }, function (err) {
                        _this.router.parent.navigate(['./AboutUs']);
                    });
                }
                MainPageComponent = __decorate([
                    core_1.Component({
                        selector: 'MainPage',
                        templateUrl: 'app/mainpage/mainpage.html',
                        pipes: [search_1.SearchPipe, pretragaKrevet_1.PretragaKrevetPipe],
                        directives: [common_1.FORM_DIRECTIVES],
                        viewBindings: [common_1.FORM_BINDINGS]
                    }), 
                    __metadata('design:paramtypes', [common_1.FormBuilder, http_1.Http, router_1.Router])
                ], MainPageComponent);
                return MainPageComponent;
            }());
            exports_1("MainPageComponent", MainPageComponent);
        }
    }
});
//# sourceMappingURL=mainpage.component.js.map