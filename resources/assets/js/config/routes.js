(function(){
	
	'use strict';

	angular
	    .module('ContactsApp')
		.config(['$routeProvider', router]);

		function router($routeProvider){
			$routeProvider
				.when('/', {
					templateUrl: 'views/contacts.html',
	        		controller: 'ContactsController',
	        		controllerAs: 'cc',
	        		title: 'Contacts'
				})
				.otherwise({
					redirectTo: '/'
				});
		}//end router

})();