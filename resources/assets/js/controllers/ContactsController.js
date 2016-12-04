(function(){
	
	'use strict';

	angular
	.module('ContactsApp')
	.controller('ContactsController', ContactsController);

	function ContactsController($scope, ContactsService, $log, $routeParams, $location, $filter){

		var cc = this;
		cc.contacts = [];
		cc.contact = {};

		cc.redirectHome = function(){
			$location.path('/');
			$location.replace();
		}

		cc.returnHttpError = function(response){
			$log.error('An HTTP request error ocurred. Please contact the Contacts App Support.');
			$log.info(response);
			cc.redirectHome();
		}

		cc.onGetAllSuccess = function(response){
			cc.contacts = [];
			angular.forEach(response.data.data, function(contact, index){
				cc.contacts.push(contact);
			});

			if(angular.isDefined($routeParams.id)){
				if($routeParams.id !== 'new'){//editing existing contact
					cc.contact = null;		
					angular.forEach(cc.contacts, function(contact, index){
						if(contact.uid == $routeParams.id ){
							cc.contact = contact;
							cc.contact.phone_number = parseInt(contact.phone_number);
						}
					});	
					if(!cc.contact){
						cc.redirectHome();
					}
				}					
			}
		}

		cc.getAll = function()
		{
			ContactsService.getAll(cc.onGetAllSuccess, cc.returnHttpError);
		}
		cc.getAll();

		cc.onUpdateContactSuccess = function(response){
			$location.path('/');
			$location.replace();
		}

		cc.updateContact = function(valid){
			if(!valid){
				cc.redirectHome();
			}
			var payload = cc.contact;
			payload.name = cc.contact.first_name;
			ContactsService.updateContact(payload, cc.onUpdateContactSuccess, cc.returnHttpError);
		}

		cc.onCreateContactSuccess = function(response){
			cc.redirectHome();
		}

		cc.createContact = function(valid){
			if(!valid){
				cc.redirectHome();
			}
			ContactsService.createContact(cc.contact, cc.onCreateContactSuccess, cc.returnHttpError);
		}

		cc.onDeleteContactSuccess = function(response){
			cc.getAll();
		}

		cc.deleteContact = function(uid){
			ContactsService.deleteContact(uid, cc.onDeleteContactSuccess, cc.returnHttpError)
		}

		cc.onRefreshContactSuccess = function(response){
			cc.redirectHome();
		}

		cc.refreshContacts = function()
		{
			ContactsService.refreshContacts(cc.onRefreshContactSuccess, cc.returnHttpError)
		}
	}

})();