<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$app->get('/competitie/public/competities', ['uses' => 'UserController@competities']);

//$app->get('/competitie/public/wedstrijden', ['uses' => 'UserController@wedstrijdenlijst']);
$app->get('/competitie/public/wedstrijden/{id}', ['uses' => 'UserController@wedstrijden']);

//$app->get('/competitie/public/klassementen', ['uses' => 'UserController@klassementenlijst']);
$app->get('/competitie/public/klassementen/{id}', ['uses' => 'UserController@klassementen']);
$app->get('/competitie/public/opzet/{id}', ['uses' => 'UserController@opzet']);
 
//$app->get('/competitie/public/kampioenen', ['uses' => 'UserController@kampioenen']);