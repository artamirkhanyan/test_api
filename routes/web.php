<?php



$router->group(['prefix' => 'api'], function () use ($router) {
    $router->post('checklist', 'ChecklistController@postIndex');
});