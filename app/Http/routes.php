<?php

// ----------------------------------------------------------------------------------------------------
// ACCUEIL

Route::get('/', 'IndexController@index');


// TEST
Route::get('test', 'TestController@index');
Route::get('test/scan', 'TestController@scanPermissions');


// ----------------------------------------------------------------------------------------------------
// AUTHENTIFICATION

// // Authentication Routes...
// $this->get('login', 'Auth\AuthController@showLoginForm');
// $this->post('login', 'Auth\AuthController@login');
// $this->get('logout', 'Auth\AuthController@logout');
//
// // Registration Routes...
// $this->get('register', 'Auth\AuthController@showRegistrationForm');
// $this->post('register', 'Auth\AuthController@register');
//
// // Password Reset Routes...
// $this->get('password/reset/{token?}', 'Auth\PasswordController@showResetForm');
// $this->post('password/email', 'Auth\PasswordController@sendResetLinkEmail');
// $this->post('password/reset', 'Auth\PasswordController@reset');




Route::get('/home', 'HomeController@index');

// ----------------------------------------------------------------------------------------------------
// ROUTES AVEC AUTHENTIFICATION
// Ex: admin/role, admin/permission, etc.
Route::group(['middleware' => ['auth', 'admin'], 'prefix' => 'admin'], function() {

});


Route::group(['middleware' => ['auth', 'customer'], 'prefix' => 'customer'], function() {

    // Gestion des rôles
    Route::resource('role', 'RoleController', ['except' => [
        'show', 'create', 'edit'
    ]]);

});


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });


Route::auth();


Route::put('/account/{id}/password', 'AccountController@editPassword');
Route::get('/account/{id}', 'AccountController@show');
Route::put('/account/{id}', 'AccountController@update');

Route::get('/send/{id}', ['uses' =>'EmailController@sendEmailReminder', 'as'=>'reminderEmail']);
