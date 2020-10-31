<?php

/**
 * Front controller
 *
 * PHP version 7.0
 */

/**
 * Composer
 */
require dirname(__DIR__) . '/vendor/autoload.php';

/**
 * Root
 */
define('ROOT', dirname(dirname(__FILE__)));

/**
 * Simple Router redirection 
 */


$request = $_SERVER['REQUEST_URI'];

use App\Controller\PropertyController;

switch ($request) {
    case '/':
        PropertyController::index();
        break;
    case '/index':
        PropertyController::index();
        break;
    case '/show':
        PropertyController::show($id);
        break;
    case '/create':
        PropertyController::create();
        break;
    case '/insert':
        PropertyController::insert($_POST, $_FILES);
        break;
    case '/edit':
        PropertyController::edit($_POST);
        break;
    case '/update':
        PropertyController::update($_POST, $_FILES);
        break;
    case '/delete':
        PropertyController::delete($_POST);
        break;
    case '/filter':
        PropertyController::filter($_POST);
        break;
    default:
        http_response_code(404);
        require dirname(__DIR__)  . '/src/views/404.php';
        break;
}



use App\Actions\GetData;

GetData::getData();
