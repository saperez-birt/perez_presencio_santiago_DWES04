<?php

#echo json_encode($usuarios);


require '../core/Router.php';
require '../app/controllers/UsuarioController.php';
require '../app/controllers/VideojuegoController.php';
require '../app/controllers/BibliotecaVideojuegosController.php';

$url = $_SERVER['QUERY_STRING'];
/* echo 'URL = ' . $url . '<br>' . '<br>'; */


/* ----- AÑADIR RUTAS VALIDAS ----- */

$router = new Router();

$router->add('/public/users/get', array(
    'controller'=> 'UsuarioController',
    'action'=>'getAllUsers'
));

$router->add('/public/users/post', array(
    'controller'=> 'UsuarioController',
    'action'=>'registerUser'
));

$router->add('/public/users/update', array(
    'controller'=> 'UsuarioController',
    'action'=>'updateAllIds'
));

$router->add('/public/users/delete', array(
    'controller'=> 'UsuarioController',
    'action'=>'deleteAllUsers'
));

$router->add('/public/users/get/{id}', array(
    'controller'=> 'UsuarioController',
    'action'=>'getUserById'
));

$router->add('/public/users/update/{id}', array(
    'controller'=> 'UsuarioController',
    'action'=>'updateUserById'
));

$router->add('/public/users/delete/{id}', array(
    'controller'=> 'UsuarioController',
    'action'=>'deleteUserById'
));

$router->add('/public/games/get', array(
    'controller'=> 'VideojuegoController',
    'action'=>'getAllVideojuegos'
));

$router->add('/public/games/post', array(
    'controller'=> 'VideojuegoController',
    'action'=>'registerVideojuego'
));

$router->add('/public/games/get/{id}', array(
    'controller'=> 'VideojuegoController',
    'action'=>'getVideojuegoById'
));

$router->add('/public/games/update/{id}', array(
    'controller'=> 'VideojuegoController',
    'action'=>'updateVideojuegoById'
));

$router->add('/public/games/delete/{id}', array(
    'controller'=> 'VideojuegoController',
    'action'=>'deleteVideojuegoById'
));

$router->add('/public/gamesLibrary/get', array(
    'controller'=> 'BibliotecaVideojuegosController',
    'action'=>'getAllBibliotecaVideojuegos'
));

$router->add('/public/gamesLibrary/post', array(
    'controller'=> 'BibliotecaVideojuegosController',
    'action'=>'registerBibliotecaVideojuego'
));

$router->add('/public/gamesLibrary/get/{id}', array(
    'controller'=> 'BibliotecaVideojuegosController',
    'action'=>'getBibliotecaVideoujegoById'
));

$router->add('/public/gamesLibrary/update/{id}', array(
    'controller'=> 'BibliotecaVideojuegosController',
    'action'=>'updateBibliotecaVideojuegosById'
));

$router->add('/public/gamesLibrary/delete/{id}', array(
    'controller'=> 'BibliotecaVideojuegosController',
    'action'=>'deleteBibliotecaVideojuegoById'
));

/* ----- PARSEAR URL ----- */

$urlParams = explode('/', $url);
$urlArray = array(
    'HTTP'=>$_SERVER['REQUEST_METHOD'],
    'path'=>$url,
    'controller'=>'',
    'action'=>'',
    'params'=>''
);

if (!empty($urlParams[2])) {
    $urlArray['controller'] = ucwords($urlParams[2]);
    if (!empty($urlParams[3])) {
        $urlArray['action'] = $urlParams[3];
        if (!empty($urlParams[4])) {
            $urlArray['params'] = $urlParams[4];
        }
    } else {
        $urlArray['action'] = 'index';
    }
} else {
    $urlArray['controller'] = 'UsuarioController';
    $urlArray['action'] = 'index';
}


/* ----- EJECUTAR CONTROLADOR Y METODO ----- */

if ($router->matchRoute($urlArray)) {
    $method = $_SERVER['REQUEST_METHOD'];
    $params = [];

    if ($method === 'GET') {
        $params[] = intval($urlArray['params']) ?? null;
    } else if ($method === 'POST') {
        $json = file_get_contents('php://input');
        $params[] = json_decode($json, true);
    } else if ($method === 'PUT') {
        $id = intval($urlArray['params']) ?? null;
        $json = file_get_contents('php://input');
        $params[] = $id;
        $params[] = json_decode($json, true);
    } else if ($method === 'DELETE') {
        $params[] = intval($urlArray['params']) ?? null;
    }

    $controller = $router->getParams()['controller'];
    $action = $router->getParams()['action'];
    
    $controller = new $controller();
    if (method_exists($controller, $action)) {
        $resp = call_user_func_array([$controller, $action], $params);
        echo json_encode(['message' => 'Request processed successfully', 'data' => $resp]);
    } else {
        http_response_code(404);
        echo json_encode(['error' => 'Method not found']);
    }
} else {
    http_response_code(404);
    echo json_encode(['error' => 'Route not found']);
}

?>