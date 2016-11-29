var elixir = require('laravel-elixir');

elixir(function(mix) {

	mix
	.copy('node_modules/angular/angular.js', 'resources/assets/js/libs/angular.js')
	.copy('node_modules/angular-route/angular-route.js', 'resources/assets/js/libs/angular-route.js')
	.copy('node_modules/angular-ui-bootstrap/dist/ui-bootstrap-tpls.js', 'resources/assets/js/libs/angular-ui-bootstrap.js')
	.copy('node_modules/angular-messages/angular-messages.js', 'resources/assets/js/libs/angular-messages.js');	
    mix.sass('app.scss');
    mix.scripts([
    	'libs/angular.js',
    	'libs/angular-route.js',
    	'libs/angular-ui-bootstrap.js',
    	'libs/angular-messages.js',
    	'app.js',
        'config/routes.js',
    	'controllers/ContactsController.js'
    ]);
});
