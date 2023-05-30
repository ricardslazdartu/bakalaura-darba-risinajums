<?php

class Router
{
    const METHOD_GET = "get";
    const METHOD_POST = "post";

    const NAME_KEY = "name";
    const EXPRESSION_KEY = "expression";
    const CONTROLLER_KEY = "controller";
    const FUNCTION_KEY = "function";
    const METHOD_KEY = "method";

    static $routes = [];
    static $routeNotFoundHandler = [];
    static $applicationHandler = [];

    public static function setRouteNotFoundHandler($controller, $method)
    {
        self::$routeNotFoundHandler = [
            self::CONTROLLER_KEY => $controller,
            self::FUNCTION_KEY => $method,
        ];
    }

    public static function setApplicationHandler($controller, $method)
    {
        self::$applicationHandler = [
            self::CONTROLLER_KEY => $controller,
            self::FUNCTION_KEY => $method,
        ];
    }

    public static function add($expression, $controller, $function, $method, $name)
    {
        self::$routes[] = [
            self::NAME_KEY => $name,
            self::EXPRESSION_KEY => $expression,
            self::CONTROLLER_KEY => $controller,
            self::FUNCTION_KEY => $function,
            self::METHOD_KEY => $method,
        ];
    }

    /**
     * @throws Exception
     */
    public static function run()
    {
        $parsed_url = parse_url($_SERVER['REQUEST_URI']);

        if (isset($parsed_url['path'])) {
            $path = $parsed_url['path'];
        } else {
            $path = '/';
        }

        $method = $_SERVER['REQUEST_METHOD'];
        $path_match_found = false;
        $route_match_found = false;

        if ($method === 'POST' && isRegularUser()) {
            throw new Exception('Action not allowed for Regular user');
        }

        foreach (self::$routes as $route) {
            $route[self::EXPRESSION_KEY] = '^' . $route[self::EXPRESSION_KEY];
            $route[self::EXPRESSION_KEY] = $route[self::EXPRESSION_KEY] . '$';

            if (preg_match('#' . $route[self::EXPRESSION_KEY] . '#', $path, $matches)) {
                $path_match_found = true;

                if (strtolower($method) == strtolower($route[self::METHOD_KEY])) {
                    array_shift($matches);

                    if ($route[self::CONTROLLER_KEY] == ApplicationController::class) {
                        $controller = new self::$applicationHandler[self::CONTROLLER_KEY];
                        $controller->{self::$applicationHandler[self::FUNCTION_KEY]}($route);

                        $route_match_found = true;

                        break;
                    }

                    $controller = new $route[self::CONTROLLER_KEY];
                    $controller->{$route[self::FUNCTION_KEY]}(...$matches);

                    $route_match_found = true;

                    break;
                }
            }
        }

        if (!$route_match_found) {
            if ($path_match_found) {
                header("HTTP/1.0 405 Method Not Allowed");
            } else {
                header("HTTP/1.0 404 Not Found");
            }

            $controller = new self::$routeNotFoundHandler[self::CONTROLLER_KEY];
            $controller->{self::$routeNotFoundHandler[self::FUNCTION_KEY]}();
        }
    }
}