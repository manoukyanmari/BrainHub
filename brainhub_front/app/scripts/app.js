'use strict';

/**
 * @ngdoc overview
 * @name brainhubFrontApp
 * @description
* # brainhubFrontApp
*
* Main module of the application.
*/
angular
  .module('brainhubFrontApp', [
    'ngAnimate',
    'ngCookies',
    'ngResource',
    'ngRoute',
    'ngSanitize',
    'ngTouch'
  ])
  .config(function ($routeProvider, $httpProvider) {
      $httpProvider.defaults.useXDomain = true;
      delete $httpProvider.defaults.headers.common['X-Requested-With'];

      console.debug($httpProvider);
    $routeProvider
      .when('/', {
        templateUrl: 'views/main.html',
        controller: 'MainCtrl'
      })
      .when('/about', {
        templateUrl: 'views/about.html',
        controller: 'AboutCtrl'
      })
      .when('/register', {
        templateUrl: 'views/register.html',
        controller: 'RegisterCtrl'
      })
      .when('/backend/users', {
        templateUrl: 'views/backendusermanager.html',
        controller: 'BackendusermanagerCtrl'
      })
      .otherwise({
        redirectTo: '/'
      });
  });
