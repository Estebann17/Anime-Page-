<?php
// Mantener la sesión iniciada
session_start();

require_once __DIR__ . "/php/connection.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"];
    $usernameOrEmail = $_POST["usernameOrEmail"];
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirmPassword"];
    $profileDetails = $_POST["profileDetails"];

    // Validar si las contraseñas coinciden
    if ($password !== $confirmPassword) {
        // Contraseñas no coinciden, mostrar mensaje de error
        $_SESSION["registerError"] = "Passwords do not match.";
        header("Location: register.php");
        exit;
    }

    // Consultar la base de datos para verificar si el username ya está en uso
    $sql = "SELECT id FROM users WHERE username = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        // El username ya está en uso, mostrar mensaje de error
        $_SESSION["registerError"] = "Username already in use. Please choose a different username.";
        header("Location: register.php");
        exit;
    }

    // Hash de la contraseña
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

   
    // Insertar el nuevo usuario en la base de datos
    $sql = "INSERT INTO users (username, usernameOrEmail, password, profile_details, profile_picture) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sssss", $username, $usernameOrEmail, $hashedPassword, $profileDetails, $profilePicData);

    if (mysqli_stmt_execute($stmt)) {
        // Obtener el ID del nuevo usuario
        $userId = mysqli_insert_id($conn);

        // Establecer la variable de sesión para el usuario registrado
        $_SESSION["userId"] = $userId;

        // Redirigir al usuario a la página de perfil o la página segura
        header("Location: login.php");
        exit;
    } else {
        // Error al registrar al usuario, mostrar mensaje de error
        $_SESSION["registerError"] = "Error registering user.";
        header("Location: register.php");
        exit;
    }
}
?>
