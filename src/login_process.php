<?php
// Mantener la sesión iniciada
session_start();

require_once __DIR__ . "/php/connection.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $usernameOrEmail = $_POST["usernameOrEmail"];
    $password = $_POST["password"];

    // Consultar la base de datos para obtener los datos del usuario
    $sql = "SELECT id, usernameOrEmail, password, profile_picture, profile_details FROM users WHERE usernameOrEmail = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $usernameOrEmail);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $userData = mysqli_fetch_assoc($result);

    // Verificar si se encontró un usuario con el nombre de usuario o correo electrónico proporcionado
    if ($userData) {
        // Verificar la contraseña proporcionada con la contraseña almacenada en la base de datos
        if (password_verify($password, $userData['password'])) {
            // Contraseña válida, establecer la sesión del usuario
            $_SESSION["userId"] = $userData['id'];
            header("Location: profile.php");
            exit;
        } else {
            // Contraseña incorrecta, mostrar mensaje de error
            $_SESSION["loginError"] = "Invalid password.";
            header("Location: login.php");
            exit;
        }
    } else {
        // Usuario no encontrado, mostrar mensaje de error
        $_SESSION["loginError"] = "User not found.";
        header("Location: login.php");
        exit;
    }
}
?>
