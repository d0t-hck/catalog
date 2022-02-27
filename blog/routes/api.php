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

$router->group(['prefix' => 'api'], function() use ($router) {
    #Author
    $router->group(['prefix' => 'authors'], function() use ($router) {

        $router->get('/', ['uses' => 'AuthorController@list']);
    
        $router->get('{id}', ['uses' => 'AuthorController@item']);
    
        $router->post('/', ['uses' => 'AuthorController@create']);
    
        $router->put('{id}', ['uses' => 'AuthorController@update']);
        
        $router->delete('{id}', ['uses' => 'AuthorController@delete']);

        // $router->get('{id}/titles', ['uses' => 'AuthorController@titles']);
    });

    #Artist
    $router->group(['prefix' => 'artists'], function() use ($router) {

        $router->get('/', ['uses' => 'ArtistController@list']);
    
        $router->get('{id}', ['uses' => 'ArtistController@item']);
    
        $router->post('/', ['uses' => 'ArtistController@create']);
    
        $router->put('{id}', ['uses' => 'ArtistController@update']);
    
        $router->delete('{id}', ['uses' => 'ArtistController@delete']);
    });

    #Publisher
    $router->group(['prefix' => 'publishers'], function() use ($router) {

        $router->get('/', ['uses' => 'PublisherController@list']);
    
        $router->get('{id}', ['uses' => 'PublisherController@item']);
    
        $router->post('/', ['uses' => 'PublisherController@create']);
    
        $router->put('{id}', ['uses' => 'PublisherController@update']);
    
        $router->delete('{id}', ['uses' => 'PublisherController@delete']);
    });

    #Genre
    $router->group(['prefix' => 'genres'], function() use ($router) {

        $router->get('/', ['uses' => 'GenreController@list']);
    
        $router->get('{id}', ['uses' => 'GenreController@item']);
    
        $router->post('/', ['uses' => 'GenreController@create']);
    
        $router->put('{id}', ['uses' => 'GenreController@update']);
    
        $router->delete('{id}', ['uses' => 'GenreController@delete']);
    });

    #Status
    $router->group(['prefix' => 'statuses'], function() use ($router) {

        $router->get('/', ['uses' => 'StatusController@list']);
    
        $router->get('{id}', ['uses' => 'StatusController@item']);
    
        $router->post('/', ['uses' => 'StatusController@create']);
    
        $router->put('{id}', ['uses' => 'StatusController@update']);
    
        $router->delete('{id}', ['uses' => 'StatusController@delete']);
    });

    #Title
    $router->group(['prefix' => 'titles'], function() use ($router) {

        $router->get('/', ['uses' => 'TitleController@list']);
    
        $router->get('{id}', ['uses' => 'TitleController@item']);
    
        $router->post('/', ['uses' => 'TitleController@create']);
    
        $router->put('{id}', ['uses' => 'TitleController@update']);
    
        $router->delete('{id}', ['uses' => 'TitleController@delete']);
    });

    #Chapter
    $router->group(['prefix' => 'chapters'], function() use ($router) {

        $router->get('/', ['uses' => 'ChapterController@list']);
    
        $router->get('{id}', ['uses' => 'ChapterController@item']);
    
        $router->post('/', ['uses' => 'ChapterController@create']);
    
        $router->put('{id}', ['uses' => 'ChapterController@update']);
    
        $router->delete('{id}', ['uses' => 'ChapterController@delete']);
    });

    #Page
    $router->group(['prefix' => 'pages'], function() use ($router) {

        $router->get('/', ['uses' => 'PageController@list']);
    
        $router->get('{id}', ['uses' => 'PageController@item']);
    
        $router->post('/', ['uses' => 'PageController@create']);
    
        $router->put('{id}', ['uses' => 'PageController@update']);
    
        $router->delete('{id}', ['uses' => 'PageController@delete']);
    
        $router->post('{id}', ['uses' => 'PageController@upload']);
    });

});