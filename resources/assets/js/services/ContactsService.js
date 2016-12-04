(function(){
	'use strict';

	angular.module('ContactsApp').service('ContactsService', contactsService);

	function contactsService($http){

		var self = this;
		self.endpoint = '/api/v1/contacts/';

		self.getAll = function(success, error){
			return $http.get(self.endpoint).then(success, error);
		}

		self.getById = function(id, success, error){
			return $http.get(self.endpoint + id).then(success, error);
		}

		self.updateContact = function(payload, success, error){
			return $http.patch(self.endpoint, payload).then(success, error);
		}

		self.createContact = function(payload, success, error){
			return $http.post(self.endpoint, payload).then(success, error);
		}

		self.deleteContact = function(uid, success, error){
			return $http.delete(self.endpoint + uid).then(success, error);
		}

		self.refreshContacts = function(success, error){
			return $http.get(self.endpoint + 'refresh').then(success, error);
		}
	}

})();