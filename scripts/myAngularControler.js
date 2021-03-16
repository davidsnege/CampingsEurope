var app = angular.module("myApp", ["ngRoute"]);
app.config(function($routeProvider) {
  $routeProvider
  .when("/", {
    templateUrl : "public/templates/homeDefault.html"
  })
  .when("/listCampings", {
    templateUrl : "public/templates/listCampings.html"
  })
});

