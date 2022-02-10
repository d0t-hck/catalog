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
    $router->get('authors', ['uses' => 'AuthorController@list']);

    $router->get('authors/{id}', ['uses' => 'AuthorController@item']);

    $router->post('authors', ['uses' => 'AuthorController@create']);

    $router->put('authors/{id}', ['uses' => 'AuthorController@update']);
    
    $router->delete('authors/{id}', ['uses' => 'AuthorController@delete']);

    #Artist
    $router->get('artists', ['uses' => 'ArtistController@list']);

    $router->get('artists/{id}', ['uses' => 'ArtistController@item']);

    $router->post('artists', ['uses' => 'ArtistController@create']);

    $router->put('artists/{id}', ['uses' => 'ArtistController@update']);

    $router->delete('artists/{id}', ['uses' => 'ArtistController@delete']);

    #Publisher
    $router->get('publishers', ['uses' => 'PublisherController@list']);

    $router->get('publishers/{id}', ['uses' => 'PublisherController@item']);

    $router->post('publishers', ['uses' => 'PublisherController@create']);

    $router->put('publishers/{id}', ['uses' => 'PublisherController@update']);

    $router->delete('publishers/{id}', ['uses' => 'PublisherController@delete']);

    #Genre
    $router->get('genres', ['uses' => 'GenreController@list']);

    $router->get('genres/{id}', ['uses' => 'GenreController@item']);

    $router->post('genres', ['uses' => 'GenreController@create']);

    $router->put('genres/{id}', ['uses' => 'GenreController@update']);

    $router->delete('genres/{id}', ['uses' => 'GenreController@delete']);

    #Status
    $router->get('statuses', ['uses' => 'StatusController@list']);

    $router->get('statuses/{id}', ['uses' => 'StatusController@item']);

    $router->post('statuses', ['uses' => 'StatusController@create']);

    $router->put('statuses/{id}', ['uses' => 'StatusController@update']);

    $router->delete('statuses/{id}', ['uses' => 'StatusController@delete']);

    #Title
    $router->get('titles', ['uses' => 'TitleController@list']);

    $router->get('titles/{id}', ['uses' => 'TitleController@item']);

    $router->post('titles', ['uses' => 'TitleController@create']);

    $router->put('titles/{id}', ['uses' => 'TitleController@update']);

    $router->delete('titles/{id}', ['uses' => 'TitleController@delete']);

    #Chapter
    $router->get('chapters', ['uses' => 'ChapterController@list']);

    $router->get('chapters/{id}', ['uses' => 'ChapterController@item']);

    $router->post('chapters', ['uses' => 'ChapterController@create']);

    $router->put('chapters/{id}', ['uses' => 'ChapterController@update']);

    $router->delete('chapters/{id}', ['uses' => 'ChapterController@delete']);

    #Page
    $router->get('pages', ['uses' => 'PageController@list']);

    $router->get('pages/{id}', ['uses' => 'PageController@item']);

    $router->post('pages', ['uses' => 'PageController@create']);

    $router->put('pages/{id}', ['uses' => 'PageController@update']);

    $router->delete('pages/{id}', ['uses' => 'PageController@delete']);

    $router->post('pages/{id}', ['uses' => 'PageController@upload']);

});