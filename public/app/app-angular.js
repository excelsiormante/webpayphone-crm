var app = angular.module('uscApp', ['angularUtils.directives.dirPagination', 'ng-decimal'], function($interpolateProvider) {
	$interpolateProvider.startSymbol('<%');
	$interpolateProvider.endSymbol('%>');
});