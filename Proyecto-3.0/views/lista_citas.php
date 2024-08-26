<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Citas</title>
    <link rel="stylesheet" href="assets/Andres/styles/admin.css">
    <?php include 'partials/header.php'?>
</head>
<body>
    <div class="citas-lista">
        <h3>Mis Citas</h3>
        <table>
            <thead>
                <tr>
                    <th>Nombre Propietario</th>
                    <th>Contacto</th>
                    <th>Nombre Mascota</th>
                    <th>Raza Mascota</th>
                    <th>Servicio</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($citas as $cita): ?>
                    <tr>
                        <td><?php echo $cita['nombre_propietario']; ?></td>
                        <td><?php echo $cita['numero_contacto']; ?></td>
                        <td><?php echo $cita['nombre_mascota']; ?></td>
                        <td><?php echo $cita['raza_mascota']; ?></td>
                        <td><?php echo $cita['servicio']; ?></td>
                        <td><?php echo $cita['fecha_cita']; ?></td>
                        <td><?php echo $cita['hora_cita']; ?></td>
                        <td>
                            <a href="index.php?controller=FormularioController&action=edit&id=<?php echo $cita['id_cita']; ?>">Editar</a>
                            <a href="index.php?controller=FormularioController&action=delete&id=<?php echo $cita['id_cita']; ?>" onclick="return confirm('¿Estás seguro de que deseas borrar esta cita?');">Borrar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
