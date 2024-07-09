<?php

namespace MVC;

class Router
{
    // Arrays to store the routes for GET and POST requests
    public $getRoutes = [];
    public $postRoutes = [];

    // Registers a function to a GET request route
    public function get($url, $fn)
    {
        $this->getRoutes[$url] = $fn;
    }

    // Registers a function to a POST request route
    public function post($url, $fn)
    {
        $this->postRoutes[$url] = $fn;
    }

    // Checks the current URL and method, then calls the corresponding function if exists
    public function checkRoutes()
    {
        $currentUrl = strtok($_SERVER['REQUEST_URI'], '?') ?? '/';
        $method = $_SERVER['REQUEST_METHOD'];

        if ($method === 'GET') {
            $fn = $this->getRoutes[$currentUrl] ?? null;
        } else {
            $fn = $this->postRoutes[$currentUrl] ?? null;
        }

        if ($fn) {
            // The URL exists and has an associated function
            call_user_func($fn, $this);
        } else {
            echo "<!DOCTYPE html>";
            echo "<html lang=\"en\">";
            echo "<head>";
            echo "<meta charset=\"UTF-8\">";
            echo "<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">";
            echo "<title>404 Not Found</title>";
            echo "</head>";
            echo "<body style=\"display: flex; justify-content: center; align-items: center; height: 100vh;\">";
            echo "<img src=\"/build/img/404.svg\" alt=\"404 Not Found\" style=\"max-width: 50%; height: auto;\">";
            echo "</body>";
            echo "</html>";
        }
    }

    // Renders a view
    public function render($view, $data = [])
    {
        // Converts the data array into variables
        foreach ($data as $key => $value) {
            $$key = $value;
        }

        ob_start();

        // Includes the specific view file
        include __DIR__ . "/views/$view.php";
        $content = ob_get_clean();
        // Includes the layout file
        include __DIR__ . "/views/layout.php";
    }
}
