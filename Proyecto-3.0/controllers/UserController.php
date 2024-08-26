<?php

require_once 'models/Database.php';

class UserController
{
    private $conn;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->conn;
    }

    public function formularioBienvenida()
    {

        $userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';

        if ($userId) {
            $user = $this->getUserById($userId);
            $pet = $this->getPetByUserId($userId);

            if ($user) {
                // Diagnóstico: Verificar los datos recuperados
                $_SESSION['nombre'] = isset($user['nombre']) ? $user['nombre'] : '';
                $_SESSION['telefono'] = isset($user['telefono']) ? $user['telefono'] : '';
                $_SESSION['mascotas'] = isset($pet) ? $pet : '';
            }


            // echo '<pre>';
            // echo 'User Data: ';
            // var_dump($user);
            // echo 'Pet Data: ';
            // var_dump($pet);
            // echo '</pre>';

            include 'views/datosUsuario.php';
        } else {
            echo 'Error: No se ha encontrado el ID del usuario.';
        }
    }

    public function store()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            // Obtener otros datos del formulario
            $email = isset($_POST['correo']) ? $_POST['correo'] : '';
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
            $telefono = isset($_POST['telefono']) ? $_POST['telefono'] : '';
            $estatura = isset($_POST['estatura']) ? $_POST['estatura'] : '';
            $nombre_mascota = isset($_POST['nombre_mascota']) ? $_POST['nombre_mascota'] : '';
            $peso = isset($_POST['peso']) ? $_POST['peso'] : '';
            $raza = isset($_POST['raza']) ? $_POST['raza'] : '';


            // Consulta para obtener el id basado en el correo
            $stmt = $this->conn->prepare("SELECT id FROM login WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->bind_result($id);
            $stmt->fetch();
            $stmt->close();

            if (!$id) {
                echo "Error: No se encontró el ID para el correo especificado.";
                return;
            }


            if ($this->userExists($id)) {
                // Actualizar datos en la tabla usuario
                $stmtUsuario = $this->conn->prepare("UPDATE usuario SET nombre = ?, telefono = ?, correo = ? WHERE id = ?");
                $stmtUsuario->bind_param("sssi", $nombre, $telefono, $email, $id);
                $stmtUsuario->execute();
                $stmtUsuario->close();

                // Actualizar datos en la tabla mascota
                $stmtMascota = $this->conn->prepare("INSERT INTO mascota (id, estatura, nombre_mascota, peso, raza) VALUES (?, ?, ?, ?, ?)");
                $stmtMascota->bind_param("idsss", $id, $estatura, $nombre_mascota, $peso, $raza);
                $stmtMascota->execute();
                $stmtMascota->close();

                echo "<script>alert('Datos guardados con exito.');</script>";

                include 'views/bienvenida.php';
            } else {
                // Insertar datos en la tabla usuario
                $stmtUsuario = $this->conn->prepare("INSERT INTO usuario (id, nombre, correo, telefono) VALUES (?, ?, ?, ?)");
                $stmtUsuario->bind_param("isss", $id, $nombre, $email, $telefono);
                $stmtUsuario->execute();
                $stmtUsuario->close();

                // Insertar datos en la tabla mascota
                $stmtMascota = $this->conn->prepare("INSERT INTO mascota (id, estatura, nombre_mascota, peso, raza) VALUES (?, ?, ?, ?, ?)");
                $stmtMascota->bind_param("idsss", $id, $estatura, $nombre_mascota, $peso, $raza);
                $stmtMascota->execute();
                $stmtMascota->close();

                echo "<script>alert('Datos guardados con exito.');</script>";

                include 'views/bienvenida.php';
            }
        } else {
            echo "Algo pasó"; // Manejar la situación donde no se recibe un POST
        }
    }

    private function userExists($id)
    {
        $stmt = $this->conn->prepare("SELECT id FROM usuario WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->store_result();
        $exists = $stmt->num_rows > 0;
        $stmt->close();
        return $exists;
    }

    private function getUserById($userId)
    {
        $stmt = $this->conn->prepare("SELECT nombre, correo, telefono FROM usuario WHERE id = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        $stmt->close();
        return $user;
    }

    private function getPetByUserId($userId)
    {
        $stmt = $this->conn->prepare("SELECT estatura, nombre_mascota, peso, raza FROM mascota WHERE id = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        $pet = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $pet;
    }
}
