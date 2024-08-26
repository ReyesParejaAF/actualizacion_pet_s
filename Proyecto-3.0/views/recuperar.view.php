<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Contraseña</title>
    <!-- Estilos -->
    <link rel="stylesheet" href="assets/david//css/styles.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<header>
    <?php include 'partials/header.php' ?>
</header>

<body style="background-image: url(assets/david/img/fondo.jpg);">
    <main>
        <div class="container w-75 rounded shadow login mt-4 mb-4">
            <div class="row align-items-stretch">
                <div class="col d-none d-lg-block col-md-5 col-lg-5 col-xl-6 rounded p-3">
                    <div class="bg"></div>
                </div>
                <div class="col p-5 rounded-end">
                    <div class="text-end">
                        <img src="img/tienda-en-linea.png" width="70" alt="">
                    </div>
                    <h2 class="fw-bold text-center py-5">Recuperar Contraseña</h2>
                    <!-- Recuperar Contraseña Form -->
                    <form action="index.php?controller=Users&action=procesarRecuperacion" method="post">
                        <div class="mb-4 position-relative">
                            <label for="email" class="form-label">Correo Electrónico</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>
                        <div class="d-grid">
                            <button style="background-color: #70d0df;" type="submit" class="btn btn-primary">Enviar Enlace de Recuperación</button>
                        </div>
                    </form>
                    <a href="index.php?controller=Users&action=mostrarFormularioLogin">Iniciar Sesión</a>
                </div>
            </div>
        </div>
    </main>

    <!-- Scripts -->
    <script src="assets/david/js/scripts.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

<footer>
    <?php include 'partials/footer.php' ?>
</footer>

</html>
