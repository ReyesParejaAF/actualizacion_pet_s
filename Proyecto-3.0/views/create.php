<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Agendar Cita</title>
  <link rel="stylesheet" href="assets/andres/styles/admin.css">
  <?php include 'partials/header.php'?>
  <style>
    #message {
      color: green;
      font-weight: bold;
      text-align: center;
      font-size: 1.4em; 
      margin-bottom: 20px; 
      font-family: 'Times New Roman', Times, serif; 
    }
    .top-buttons {
      display: flex;
      justify-content: space-between;
      margin-bottom: 20px;
    }
    .top-buttons a {
      padding: 10px 20px;
      background-color: #007BFF;
      color: white;
      text-decoration: none;
      border-radius: 5px;
      text-align: center;
    }
    .top-buttons a:hover {
      background-color: #0056b3;
    }
  </style>
</head>
<body>
  <div class="citas1">
    <div class="top-buttons">
      <h3>Agende su cita:</h3>
      <a href="index.php?controller=FormularioController&action=list" class="btn btn-primary">Ver Mis Citas</a>
    </div>

    <?php if (isset($_SESSION['success_message'])): ?>
        <div id="message" style="color:green;">
            <?php 
            echo $_SESSION['success_message'];
            unset($_SESSION['success_message']);
            ?>
        </div>
    <?php elseif (isset($_SESSION['error_message'])): ?>
        <div id="message" style="color:red;">
            <?php 
            echo $_SESSION['error_message'];
            unset($_SESSION['error_message']);
            ?>
        </div>
    <?php endif; ?>

    <form id="citaForm" action="index.php?controller=FormularioController&action=create" method="POST" onsubmit="return validarFormulario()">
      <label for="nombre">Nombre del propietario:*</label>
      <input type="text" name="name" id="nombre" value="<?php echo isset($mascota_data['nombre_propietario']) ? htmlspecialchars($mascota_data['nombre_propietario']) : ''; ?>" required>

      <label for="contacto">Numero de contacto:*</label>
      <input type="tel" name="tel" id="contacto" value="<?php echo isset($mascota_data['numero_contacto']) ? htmlspecialchars($mascota_data['numero_contacto']) : ''; ?>" required>

      <label for="nmascota">Nombre de la mascota:</label>
      <input type="text" name="mascota" id="nmascota" value="<?php echo isset($mascota_data['nombre_mascota']) ? htmlspecialchars($mascota_data['nombre_mascota']) : ''; ?>">

      <label for="rmascota">Raza de la mascota:*</label>
      <input type="text" name="razamascota" id="rmascota" value="<?php echo isset($mascota_data['raza_mascota']) ? htmlspecialchars($mascota_data['raza_mascota']) : ''; ?>" required>

      <label for="servicio">Servicio:*</label>
      <input type="text" name="servicio" id="servicio" required>

      <label for="fecha">Fecha de la cita:*</label>
      <input type="date" name="fecha" id="fecha" oninput="validarFecha()" required><br><br>

      <label for="hora">Hora de la cita:*</label>
      <input type="time" name="hora" id="hora" required>
      
      <br><br>

      <div class="bottom-buttons">
        <a href="camilo_vista">Agregar productos</a>
        <input type="submit" value="Agendar">
      </div>
    </form>

    <script>
      function validarFormulario() {
        var nombre = document.getElementById('nombre').value.trim();
        var contacto = document.getElementById('contacto').value.trim();
        var rmascota = document.getElementById('rmascota').value.trim();
        var servicio = document.getElementById('servicio').value.trim();
        var fecha = document.getElementById('fecha').value;
        var hora = document.getElementById('hora').value;

        if (nombre === '' || contacto === '' || rmascota === '' || servicio === '' || fecha === '' || hora === '') {
          alert('Por favor, complete los campos obligatorios (*) para proceder al envío.');
          return false;
        }

        var today = new Date().toISOString().split('T')[0];
        if (fecha < today) {
          alert('Seleccione una fecha futura para la cita.');
          return false;
        }

        return true;
      }

      function validarFecha() {
        var fecha = document.getElementById('fecha').value;
        var today = new Date().toISOString().split('T')[0];

        if (fecha < today) {
          alert('Seleccione una fecha futura para la cita.');
        }
      }
    </script>
  </div>
</body>
</html>
