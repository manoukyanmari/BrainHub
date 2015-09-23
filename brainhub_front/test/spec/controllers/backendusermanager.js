'use strict';

describe('Controller: BackendusermanagerCtrl', function () {

  // load the controller's module
  beforeEach(module('brainhubFrontApp'));

  var BackendusermanagerCtrl,
    scope;

  // Initialize the controller and a mock scope
  beforeEach(inject(function ($controller, $rootScope) {
    scope = $rootScope.$new();
    BackendusermanagerCtrl = $controller('BackendusermanagerCtrl', {
      $scope: scope
    });
  }));

  it('should attach a list of awesomeThings to the scope', function () {
    expect(scope.awesomeThings.length).toBe(3);
  });
});
