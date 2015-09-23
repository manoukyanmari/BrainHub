'use strict';

/**
 * @ngdoc function
 * @name brainhubFrontApp.controller:MainCtrl
 * @description
 * # MainCtrl
 * Controller of the brainhubFrontApp
 */
angular.module('brainhubFrontApp')
  .controller('MainCtrl', function ($scope, $http) {
    $scope.awesomeThings = [
      'HTML5 Boilerplate',
      'AngularJS',
      'Karma'
    ];

      $scope.registerUser = function(user){
        console.debug(user);
        $http({
          method: 'POST',
          url: '//api.brainhub.dev/users/register',
          headers: {
            'Content-Type': 'text/plain'
          },
          data: JSON.stringify(user)
        }).success(function(data){
          console.debug(data);
        });

      };


  });
