<!DOCTYPE html>
<html>

<head>
  <title>Bienvenida</title>
  <?php include 'partials/header.php' ?>
  <link rel="stylesheet" href="assets/felipe/css/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <style>
    .registro {
      background: linear-gradient(#70d0df, #e2e2e2, #70d0df);
    }
  </style>
</head>

<body>
  <!-- <h1>Bienvenido, <?php

                        echo htmlspecialchars($_SESSION['nombre']);

                        ?></h1> -->
  <section>
    <div class="registro container mt-5 p-4 rounded">
      <h1>Registro de Datos</h1>
      <form class="formulario" action="index.php?controller=UserController&action=store" method="POST">
        <div class="form-group">
          <label for="nombre">Nombre Completo:</label>
          <input name="nombre" type="text" class="form-control" id="nombre" placeholder="Escribe tu nombre" value="<?php echo isset($_SESSION['nombre']) ? htmlspecialchars($_SESSION['nombre']) : ''; ?>" required>
          <span style="display: none;" class="advertencia">campo nombre obligatorio</span>
        </div>
        <div class="form-group">
          <label for="email">Correo Electrónico:</label>
          <input type="email" name="correo" class="form-control" id="correo" value="<?php echo isset($_SESSION['email']) ? htmlspecialchars($_SESSION['email']) : ''; ?>" required>
          <span style="display: none;" class="advertencia">campo correo obligatorio</span>
        </div>
        <div class="form-group">
          <label for="telefono">Teléfono:</label>
          <input name="telefono" type="tel" class="form-control" id="telefono" placeholder="Escribe tu número de teléfono" value="<?php echo isset($_SESSION['telefono']) ? htmlspecialchars($_SESSION['telefono']) : ''; ?>" required>
          <span style="display: none;" class="advertencia">campo teléfono obligatorio</span>
        </div>
        <div class="form-group">
          <label for="estatura-mascota">Estatura de tu mascota Cm:</label>
          <input name="estatura" type="number" class="form-control" id="estatura-mascota" placeholder="Estatura de tu mascota" required>
          <span style="display: none;" class="advertencia">campo estatura obligatorio</span>
        </div>
        <div class="form-group">
          <label for="peso-mascota">Peso de tu mascota Kg:</label>
          <input name="peso" type="number" class="form-control" id="peso-mascota" placeholder="Peso de tu mascota" required>
          <span style="display: none;" class="advertencia">campo peso obligatorio</span>
        </div>
        <div class="form-group">
          <label for="raza-mascota">Raza de tu mascota:</label>
          <input name="raza" type="text" class="form-control" id="raza-mascota" placeholder="Raza de tu mascota">
          <span style="display: none;" class="advertencia">campo raza obligatorio</span>
        </div>
        <div class="form-group">
          <label for="nombre-mascota">Nombre de mascota:</label>
          <input name="nombre_mascota" type="text" class="form-control" id="nombre-mascota" placeholder="Escribe nombre" required>
          <span style="display: none;" class="advertencia">campo nombre mascota obligatorio</span>
        </div>
        <input type="hidden" name="id" value="<?php echo isset($_POST['id']) ? htmlspecialchars($_POST['id']) : ''; ?>">
        <?php if (!isset($_SESSION['nombre'])) { ?>
          <button type="submit" id="boton" class="btn btn-primary">Registrar</button>
        <?php } else { ?>
          <button type="submit" id="boton" class="btn btn-primary">Actualizar y registrar mascota</button>
        <?php } ?>
        <!-- Nuevo botón para volver a la vista de bienvenida -->
        <a href="index.php?controller=WelcomeController&action=index" class="btn btn-secondary ms-2">Volver a Bienvenida</a>
      </form>
    </div>
    <div class="registro container mt-5 p-4 rounded">
      <h1>Mis mascotas</h1>

      <table class="table">
        <thead>
          <tr>
            <th scope="col">Nombre</th>
            <th scope="col">Raza</th>
            <th scope="col">Peso</th>
            <th scope="col">Estatura</th>
          </tr>
        </thead>
        <tbody>
          <?php
          if (isset($_SESSION['mascotas'])) {

            foreach ($_SESSION['mascotas'] as $mascota) { ?>
              <tr>
                <td><?php echo $mascota['nombre_mascota']; ?></td>
                <td><?php echo $mascota['raza']; ?></td>
                <td><?php echo $mascota['peso']; ?></td>
                <td><?php echo $mascota['estatura']; ?></td>
              </tr>
          <?php }
          } ?>
        </tbody>
      </table>
    </div>
    <script src="assets/felipe/js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
      crossorigin="anonymous"></script>


  </section>

  <!-- <a href="logout.php">Cerrar Sesión</a> -->
</body>

</html>