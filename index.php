<?php

$routes = explode('/', $_SERVER['REQUEST_URI']);

if (empty($routes[1])) {
    $page_number = 1;
    require 'controllers/books-controller.php';
} else if (preg_match('/^\?page=[0-9]+$/', $routes[1])) {
    $page_number = $_GET['page'];
    require 'controllers/books-controller.php';
} else if ($routes[1] == 'book' && !empty($routes[2]) && is_numeric($routes[2]) || isset($_POST['clickId'])) {
    require 'controllers/book-controller.php';
} else if (isset($_GET['search'])) {
    if ($routes[1] == 'book') {
        header("Location: http://lvl3.loc/search-book?search=" . $_GET['search']);
    }
    require 'controllers/search-controller.php';
} else if ($routes[1] == 'admin') {

    if (!empty($routes[2]) && $routes[2] == 'logout') {
        header('WWW-Authenticate: Basic realm="My Realm"');
        header('HTTP/1.0 401 Unauthorized');
    } else if (isset($_SERVER['PHP_AUTH_USER'])) {

        if ($_SERVER['PHP_AUTH_USER'] == 'admin' &&
            $_SERVER['PHP_AUTH_PW'] == 'password') {
            $page_number = 1;
            if (!empty($routes[2])) {
                if (preg_match('/^\?table-page=[0-9]+$/', $routes[2])) {
                    $page_number = $_GET['table-page'];
                } else if (empty($_GET['delete'])) {
                    require 'views/404.php';
                    exit;
                }
            }
            require 'controllers/admin-controller.php';
        } else {
            header('HTTP/1.0 401 Unauthorized');
            echo '<H1 style="text-align: center">incorrect username or password</H1>';
        }

    } else {
        header('WWW-Authenticate: Basic realm="My Realm"');
        header('HTTP/1.0 401 Unauthorized');
        echo '<H1 style="text-align: center">you need to log in</H1>';
    }

} else {
    require 'views/404.php';
}