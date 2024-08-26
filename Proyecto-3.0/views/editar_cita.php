<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cita</title>
    <link rel="stylesheet" href="assets/Andres/styles/admin.css">
    <?php include 'partials/header.php'?>
</head>
<body>
    <div class="citas-lista">
        <h3>Editar Cita</h3>
        <form id="citaForm" action="index.php?controller=FormularioController&action=edit" method="POST">
            <input type="hidden" name="id_cita" value="<?php echo $cita['id_cita']; ?>">
            <label for="nombre">Nombre del propietario:*</label>
            <input type="text" name="name" id="nombre" value="<?php echo $cita['nombre_propietario']; ?>" required>

            <label for="contacto">Número de contacto:*</label>
            <input type="tel" name="tel" id="contacto" value="<?php echo $cita['numero_contacto']; ?>" required>

            <label for="nmascota">Nombre de la mascota:</label>
            <input type="text" name="mascota" id="nmascota" value="<?php echo $cita['nombre_mascota']; ?>">

            <label for="rmascota">Raza de la mascota:*</label>
            <input type="text" name="razamascota" id="rmascota" value="<?php echo $cita['raza_mascota']; ?>" required>

            <label for="servicio">Servicio:*</label>
            <input type="text" name="servicio" id="servicio" value="<?php echo $cita['servicio']; ?>" required>

            <label for="fecha">Fecha de la cita:*</label>
            <input type="date" name="fecha" id="fecha" value="<?php echo $cita['fecha_cita']; ?>" required><br><br>

            <label for="hora">Hora de la cita:*</label>
            <input type="time" name="hora" id="hora" value="<?php echo $cita['hora_cita']; ?>" required>

            <br><br>

            <input type="submit" value="Actualizar Cita">
        </form>
    </div>
</body>
</html>
