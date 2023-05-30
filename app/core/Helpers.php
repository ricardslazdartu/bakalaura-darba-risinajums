<?php

function renderWithVariables($file, $variables = [])
{
    ob_start();
    extract($variables);
    require(sprintf("app/Views/%s", $file));

    echo ob_get_clean();
}

function url($routeName, ...$args)
{
    $route = array_filter(Router::$routes, function ($route) use ($routeName) {
        return $route[Router::NAME_KEY] === $routeName;
    });

    $expression = reset($route)[Router::EXPRESSION_KEY];

    foreach ($args as $arg) {
        $expression = replaceFirstMatch('([0-9]*)', $arg, $expression);
    }

    return $expression;
}

function replaceFirstMatch($search, $replace, $subject)
{
    return preg_replace(sprintf('/%s/', preg_quote($search, '/')), $replace, $subject, 1);
}

function isRegularUser()
{
    if (isset($_SESSION['user'])) {
        if ($_SESSION['user']['role'] === UsersRepository::REGULAR_USER) {
            return true;
        }
    }

    return false;
}

function isAdminUser()
{
    if (isset($_SESSION['user'])) {
        if ($_SESSION['user']['role'] === UsersRepository::ADMIN_USER) {
            return true;
        }
    }

    return false;
}

function isEditor()
{
    if (isset($_SESSION['user'])) {
        if ($_SESSION['user']['role'] === UsersRepository::EDITOR_USER) {
            return true;
        }
    }

    return false;
}