<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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

$router->get('/', function () use ($router) {
    return $router->app->version();
});
$router->group(['prefix'=>'api'], function($router){
    //organizations
    $router->get('organizations','OrganizationController@showAllComapny');
    $router->get('organization/{id}','OrganizationController@getCompany');
    $router->post('organizations','OrganizationController@create');
    $router->put('organizations/{id}','OrganizationController@update');
    $router->delete('organizations/{id}','OrganizationController@delete');
    //Services
    $router->get('organizations/services','OrganizationController@getOrganServices');
    $router->get('organization/services/{id}','OrganizationController@getService');
    $router->post('organizations/add-service','OrganizationController@addOrganService');
    $router->put('organizations/services{id}','OrganizationController@updateService');
    $router->delete('organizations/services/{id}','OrganizationController@deleteService');
  
    //Posts
    $router->get('posts','PostController@showAllPosts');
    $router->get('posts/{id}','PostController@showOnePost');
    $router->post('posts','PostController@create');
    $router->put('posts/{id}','PostController@update');
    $router->delete('posts/{id}','PostController@delete');
     //Users
     $router->get('users','UserController@showUsers');
     $router->get('users/{id}','UserController@getUser');
     $router->post('users','UserController@create');
     $router->put('users/{id}','UserController@update');
     $router->delete('users/{id}','UserController@delete');
     //Contact
     $router->get('organizations/contacts','ContactController@showAllContacts');
    $router->get('organization/contacts/{id}','ContactController@getOrganContact');
    $router->post('organizations/add-contact','ContactController@create');
    $router->put('organizations/conacts{id}','ContactController@update');
    $router->delete('organizations/conacts/{id}','ContactController@delete');
   //Media
   $router->get('organizations/medias','MediaController@showAllMedias');
   $router->get('organization/medias/{id}','MediaController@getOrganMedia');
   $router->post('organizations/add-media','MediaController@create');
   $router->put('organizations/media{id}','MediaController@update');
   $router->delete('organizations/media/{id}','MediaController@delete');
 
});