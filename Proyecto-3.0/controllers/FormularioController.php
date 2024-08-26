<?php

require_once __DIR__ . '\..\models\Formulario.php';

class FormularioController {
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }

            if (!isset($_SESSION['id_mascota'])) {
                // Asegúrate de que esta sesión esté estableciendo el id de la mascota correcta.
                $_SESSION['id_mascota'] = 1; // Esto es solo un ejemplo.
            }

            $mascota_id = $_SESSION['id_mascota'];
            $formulario = new Formulario();
            $mascota_data = $formulario->getById($mascota_id, $mascota_id);
            $mascota_data = $formulario->getMascotaDataById($mascota_id);

            $formulario->nombre_propietario = isset($_POST['name']) ? $_POST['name'] : '';
            $formulario->numero_contacto = isset($_POST['tel']) ? $_POST['tel'] : '';
            $formulario->nombre_mascota = isset($_POST['mascota']) ? $_POST['mascota'] : '';
            $formulario->raza_mascota = isset($_POST['razamascota']) ? $_POST['razamascota'] : '';
            $formulario->servicio = isset($_POST['servicio']) ? $_POST['servicio'] : '';
            $formulario->fecha_cita = isset($_POST['fecha']) ? $_POST['fecha'] : '';
            $formulario->hora_cita = isset($_POST['hora']) ? $_POST['hora'] : '';
            $formulario->id_mascota = $mascota_id;

            if ($formulario->create()) {
                echo "<script>alert('Cita agendada exitosamente.'); window.location.href='index.php?controller=FormularioController&action=create';</script>";
            } else {
                echo "<script>alert('Error al agendar la cita.'); window.location.href='index.php?controller=FormularioController&action=create';</script>";
            }
        } elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
            require_once 'views/create.php';
        } else {
            echo "Método de solicitud no permitido.";
        }
    }

    public function list() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['id_mascota'])) {
            $_SESSION['id_mascota'] = 1; // Esto es solo un ejemplo.
        }

        $mascota_id = $_SESSION['id_mascota'];
        $formulario = new Formulario();
        $citas = $formulario->getAllByMascota($mascota_id);

        require_once 'views/lista_citas.php';
    }

    public function delete() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['id_mascota'])) {
            $_SESSION['id_mascota'] = 1; // Esto es solo un ejemplo.
        }

        $mascota_id = $_SESSION['id_mascota'];
        $id_cita = $_GET['id'] ?? null;

        if ($id_cita) {
            $formulario = new Formulario();
            if ($formulario->deleteById($id_cita, $mascota_id)) {
                echo "Cita borrada exitosamente.";
            } else {
                echo "Error al borrar la cita.";
            }
        }
    }

    public function edit() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            if (!isset($_SESSION['id_mascota'])) {
                $_SESSION['id_mascota'] = 1; // Esto es solo un ejemplo.
            }

            $mascota_id = $_SESSION['id_mascota'];
            $id_cita = $_POST['id_cita'] ?? null;
            $formulario = new Formulario();

            if ($id_cita) {
                $formulario->id_cita = $id_cita;
                $formulario->nombre_propietario = $_POST['name'] ?? '';
                $formulario->numero_contacto = $_POST['tel'] ?? '';
                $formulario->nombre_mascota = $_POST['mascota'] ?? '';
                $formulario->raza_mascota = $_POST['razamascota'] ?? '';
                $formulario->servicio = $_POST['servicio'] ?? '';
                $formulario->fecha_cita = $_POST['fecha'] ?? '';
                $formulario->hora_cita = $_POST['hora'] ?? '';
                $formulario->id_mascota = $mascota_id;

                if ($formulario->update()) {
                    echo "<script>alert('Cita actualizada exitosamente.'); window.location.href='index.php?controller=FormularioController&action=list';</script>";
                } else {
                    echo "<script>alert('Error al actualizar la cita.'); window.location.href='index.php?controller=FormularioController&action=list';</script>";
                }
            }
        } elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            if (!isset($_SESSION['id_mascota'])) {
                $_SESSION['id_mascota'] = 1; // Esto es solo un ejemplo.
            }

            $mascota_id = $_SESSION['id_mascota'];
            $id_cita = $_GET['id'] ?? null;

            if ($id_cita) {
                $formulario = new Formulario();
                $cita = $formulario->getById($id_cita, $mascota_id);

                if ($cita) {
                    require_once 'views/editar_cita.php';
                } else {
                    echo "<script>alert('Cita no encontrada.'); window.location.href='index.php?controller=FormularioController&action=list';</script>";
                }
            }
        } else {
            echo "Método de solicitud no permitido.";
        }
    }
}
