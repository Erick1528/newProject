<?php
////////////////////////////////////////////////////////////////////////////////////////////////
require_once __DIR__ . '/../includes/app.php';
////////////////////////////////////////////////////////////////////////////////////////////////
use MVC\Router;
use Controllers\PagesController;
////////////////////////////////////////////////////////////////////////////////////////////////
$router = new Router();
////////////////////////////////////////////////////////////////////////////////////////////////

/**
 * Route definition for the home page.
 *
 * This route maps the root URL ("/") to the index method of the PagesController class.
 * It uses the GET method, suitable for retrieving resources without affecting the server state.
 *
 * For handling POST requests, where data is sent to the server to create or update resources,
 * a similar syntax is used with $router->post().
 *
 * @param string $route The URL path to match.
 * @param array $callback The callback function or class method to execute when the route is matched. The array format is [ClassName::class, 'methodName'].
 * @return void
 */

// Public Pages
$router->get('/', [PagesController::class, 'index']);

////////////////////////////////////////////////////////////////////////////////////////////////
$router->checkRoutes();
