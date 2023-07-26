<?php
// Iniciar la sesión si aún no está iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Destruir la sesión actual
session_destroy();

// Redireccionar al usuario a la página de inicio de sesión
header("Location: login.php");
exit;
?>
