<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pet-Stylo</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/david/css/styles.css">
    
    <style>
        footer {
            background-color: #70d0df;
        }

        .navbar-nav .dropdown-menu {
            z-index: 1050; /* Asegúrate de que este valor sea mayor que otros elementos de la página */
        }
    </style>
</head>
<body>
    <header class="navbar navbar-expand-sm fondoHeader w-100">
        <div class="container-fluid">
            <!-- Icono -->
            <a class="navbar-brand" href="?">
                <img class="logo" src="assets/david/img/logo sin fondo.png" alt="">
            </a>
            <!-- Icono menú -->
            <button style="background-color: #ee8133;" class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Elementos del menú colapsable -->
            <div style="background-color: #70d0df;" class="collapse navbar-collapse rounded p-4" id="menu">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <a style="background-color: #ee8133;" class="btn nav-link dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown">Horarios</a>
                        <ul class="dropdown-menu">
                            <li class="dropdown-item">Lunes a Viernes: 8:00am a 6:00pm</li>
                            <li class="dropdown-item">Sábados y Domingos: 11:00am a 4:00pm</li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link icon-link" href="#">Ayuda</a>
                        <img style="width: 20px;" src="assets/david/img/informacion.png">
                    </li>
                </ul>   
                <a class="d-flex ms-auto" href="index.php?controller=Users&action=mostrarFormularioLogin">Iniciar Sesión</a>
            </div>
        </div>
    </header>
    <script src="js/bootstrap.min.js"></script>
    <script src="bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
