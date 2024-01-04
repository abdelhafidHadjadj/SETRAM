<?php

class Router
{
    private $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function get($route, $controller)
    {
        $uri = $this->sanitizeUri($this->request);
        $route = trim($route, "/");

        if ($this->isMatchingRoute($uri, $route)) {
            $args = $this->extractArguments($uri, $route);
            $this->loadController($controller, $args);
        }
    }

    private function sanitizeUri($uri)
    {
        return trim($uri, "/");
    }

    private function isMatchingRoute($uri, $route)
    {
        $uriParts = explode("/", $uri);
        $routeParts = explode("/", $route);

        // Check if the route parts match the corresponding URI parts
        foreach ($routeParts as $index => $part) {
            if (!isset($uriParts[$index]) || $uriParts[$index] !== $part) {
                return false;
            }
        }

        return true;
    }

    private function extractArguments($uri, $route)
    {
        $args = [];
        $uriParts = explode("/", $uri);
        $routeParts = explode("/", $route);

        // Extract arguments from the URI
        foreach ($routeParts as $index => $part) {
            if (isset($uriParts[$index]) && $uriParts[$index] !== $part) {
                $args[] = $uriParts[$index];
            }
        }

        return $args;
    }

    private function loadController($controller, $args)
    {
        $controllerFile = $controller . '.php';

        if (file_exists($controllerFile)) {
            // Pass $args to the controller if needed
            require $controllerFile;
        } else {
            // Handle file not found error gracefully
            echo "Controller file not found.";
        }
    }
}
