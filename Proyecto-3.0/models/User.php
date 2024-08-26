<?php
require_once 'database.php';

class User {
    private $conn;

    public function __construct() {
        $this->conn = (new Database())->conn;
    }

    public function crearUsuario($email, $password) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO login (email, password) VALUES (?, ?)";
        
        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("ss", $email, $hashed_password);
            $stmt->execute();

            // Verificar si se insertó correctamente
            if ($stmt->affected_rows > 0) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            // Manejo de errores
            echo "Error al crear usuario: " . $e->getMessage();
            return false;
        } finally {
            // Siempre cerrar el statement después de usarlo
            $stmt->close();
        }
    }

    public function verificarUsuario($email, $password) {
        $sql = "SELECT id, password FROM login WHERE email = ?";
        
        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->bind_result($id,$hashed_password);
            $stmt->fetch();
            // Verificar si la contraseña coincide
            if (password_verify($password, $hashed_password)) {
                return $id;
            } else {
                return false;
            }
        } catch (Exception $e) {
            // Manejo de errores
            echo "Error al verificar usuario: " . $e->getMessage();
            return false;
        } finally {
            // Siempre cerrar el statement después de usarlo
            $stmt->close();
        }
    }

    // Encuentra un usuario por su correo electrónico
    public function encontrarUsuarioPorEmail($email) {
        $sql = "SELECT * FROM login WHERE email = ?";
        
        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();
            $user = $result->fetch_assoc();
            return $user;
        } catch (Exception $e) {
            echo "Error al encontrar usuario: " . $e->getMessage();
            return false;
        } finally {
            // Siempre cerrar el statement después de usarlo
            $stmt->close();
        }
    }

    // Actualiza el token de recuperación y su expiración
    public function actualizarToken($email, $token, $expiry) {
        $sql = "UPDATE login SET reset_token = ?, token_expiry = ? WHERE email = ?";
        
        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("sss", $token, $expiry, $email);
            $stmt->execute();
            return $stmt->affected_rows > 0;
        } catch (Exception $e) {
            echo "Error al actualizar token: " . $e->getMessage();
            return false;
        } finally {
            // Siempre cerrar el statement después de usarlo
            $stmt->close();
        }
    }

    // Encuentra un usuario por su token de recuperación
    public function encontrarUsuarioPorToken($token) {
        $sql = "SELECT * FROM login WHERE reset_token = ? AND token_expiry > NOW()";
        
        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("s", $token);
            $stmt->execute();
            $result = $stmt->get_result();
            $user = $result->fetch_assoc();
            return $user;
        } catch (Exception $e) {
            echo "Error al encontrar usuario por token: " . $e->getMessage();
            return false;
        } finally {
            // Siempre cerrar el statement después de usarlo
            $stmt->close();
        }
    }

    // Actualiza la contraseña del usuario
    public function actualizarPassword($id, $password) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "UPDATE login SET password = ? WHERE id = ?";
        
        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("si", $hashed_password, $id);
            $stmt->execute();
            return $stmt->affected_rows > 0;
        } catch (Exception $e) {
            echo "Error al actualizar contraseña: " . $e->getMessage();
            return false;
        } finally {
            // Siempre cerrar el statement después de usarlo
            $stmt->close();
        }
    }
}
?>




