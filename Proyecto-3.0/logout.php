<?php
session_start();
session_destroy();
header("Location: index.php?controller=Users&action=mostrarFormularioLogin&message=logout_success");
exit();
?>

