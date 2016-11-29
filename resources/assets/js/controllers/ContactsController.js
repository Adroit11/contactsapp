(function(){
	
	'use strict';

	angular
	.module('ContactsApp')
	.controller('ContactsController', ContactsController);

	function ContactsController($scope){

		var cc = this;

		console.log('controller here');
	}

})();