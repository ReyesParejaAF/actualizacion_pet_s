<?php
require_once "models/database.php"; // Incluir configuración de la base de datos
require_once "models/User.php"; // Incluir el modelo User
require 'vendor/autoload.php'; // Incluir composer

// Mapeo de nombres de controladores en español a inglés
$controllerMap = [
    'usuario' => 'Users',
    'Users' => 'Users'
    // Agrega otros mapeos si es necesario
];

session_start();

// Obtener el nombre del controlador de la solicitud
$controllerName = isset($_REQUEST['controller']) ? $_REQUEST['controller'] : 'WelcomeController';
$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : 'index';

// Convertir el nombre del controlador al formato esperado (si es necesario)
if (isset($controllerMap[$controllerName])) {
    $controllerName = $controllerMap[$controllerName];
}

// Construir el nombre del archivo del controlador
$controllerFile = "controllers/" . $controllerName . ".php";

// Verificar que el archivo del controlador exista antes de incluirlo
if (file_exists($controllerFile)) {
    require_once $controllerFile;

    // Verificar que la clase exista en el archivo
    if (class_exists($controllerName)) {
        // Crear una instancia del controlador
        $controllerObject = new $controllerName();

        // Verificar que la acción exista en el controlador antes de llamarla
        if (method_exists($controllerObject, $action)) {
            call_user_func(array($controllerObject, $action));
        } else {
            // Manejar el caso donde la acción no existe
            echo "La acción '$action' no existe en el controlador '$controllerName'.";
        }
    } else {
        // Manejar el caso donde la clase del controlador no existe
        echo "La clase '$controllerName' no existe en el archivo '$controllerFile'.";
    }
} else {
    // Manejar el caso donde el archivo del controlador no existe
    echo "El archivo del controlador '$controllerFile' no existe.";
}
?>

