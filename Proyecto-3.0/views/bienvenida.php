<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Bienvenida</title>
    <link
      href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link href="assets/styles.css" rel="stylesheet" />
    <!-- Vincular la hoja de estilos externa -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
      crossorigin="anonymous"
    />
  </head>

  <body style="background-image: url(assets/david/img/fondo.jpg)">
    <header>
      <?php include 'partials/header.php' ?>
    </header>

    <div class="container d-flex flex-column align-items-center">
      <div class="row">
        <h1 class="col">Bienvenido, a Pet-Stylo</h1>
      </div>
    </div>

    <div
      class="container d-flex bg-transparent justify-content-center align-items-center"
    >
      <div class="card bg-transparent position-relative w-50 mx-3">
        <img
          src="assets/david/img/lobby/registro.jpg"
          class="img-fluid"
          alt="Registra tus datos"
        />
        <a
          href="?controller=UserController&action=formularioBienvenida"
          class="card-overlay"
          >Registra tus datos</a
        >
      </div>
      <div class="card bg-transparent position-relative w-50 mx-3">
        <img
          src="assets/david/img/lobby/cita.jpg"
          class="img-fluid"
          alt="Agenda tu cita"
        />
        <a
          href="?controller=FormularioController&action=create"
          class="card-overlay"
          >Agenda tu cita</a
        >
      </div>
    </div>

    <a href="logout.php" class="d-block text-center mt-3">Cerrar Sesión</a>

    <footer>
      <?php include 'partials/footer.php' ?>
    </footer>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
