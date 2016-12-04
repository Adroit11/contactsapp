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
				.when('/new', {
					templateUrl: 'views/contactsCreate.html',
					controller: 'ContactsController',
					controllerAs: 'cc',
					title: 'Create Contact'
				})
				.when('/:id', {
					templateUrl: 'views/contactsEdit.html',
					controller: 'ContactsController',
					controllerAs: 'cc',
					title: 'Edit Contact'
				})
				.otherwise({
					redirectTo: '/'
				});
		}//end router

})();