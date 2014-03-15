#SimpleGravatar

[![Build Status](https://travis-ci.org/euantorano/SimpleGravatar.png)](https://travis-ci.org/euantorano/SimpleGravatar)

A super simple class to generate Gravatar images based on email addresses. Built to work with Laravel 4.

##Usage Example

Add the Service Provider to your app/config/app.php file:

	/*
	|--------------------------------------------------------------------------
	| Autoloaded Service Providers
	|--------------------------------------------------------------------------
	|
	| The service providers listed here will be automatically loaded on the
	| request to your application. Feel free to add your own services to
	| this array to grant expanded functionality to your applications.
	|
	*/

	'providers' => array(
		...
		'Euantor\SimpleGravatar\SimpleGravatarServiceProvider',
	),

Use the Gravatar class within your app:

	$gravatar = App::make('simplegravatar');
	$gravatarUrl = $gravatar->getGravatar('email@domain.com');

You can optionally change the options too using a variety of methods to set the size for the gravatar, the default image to be used if the gravatar doesn't exist, whether to use a secure (HTTPS) connection and more:

	$gravatarUrl = $gravatar->setSecure(true)->setExtension('jpg')->setSize(32)->setDefault('identicon')->getGravatar('email@domain.com');

Preferences are stored as attributes of the $gravatar object so once you set the attributes once, you don't need to do so again - meaning subsequently you only need call

	$gravatar->getGravatar('newEmail@domain.com');

###Alternative usage

There is also a GravatarFacade class shipped with the package allowing you to easily use the Gravatar facade once it has been added to your app/config/app.php file.
