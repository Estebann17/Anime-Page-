<?php
// update_profile_picture.php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require_once __DIR__ . "/php/connection.php";

// Verificar si el usuario está logeado
if (!isset($_SESSION["userId"])) {
    http_response_code(401);
    exit("Unauthorized");
}

// Obtener el ID del usuario desde la sesión
$userId = $_SESSION["userId"];

// Verificar si se enviaron datos mediante POST y si hay una imagen válida
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_FILES["profilePic"]) && $_FILES["profilePic"]["error"] === UPLOAD_ERR_OK) {
    $profilePicTmpName = $_FILES["profilePic"]["tmp_name"];
    $profilePicSize = $_FILES["profilePic"]["size"];
    $profilePicType = $_FILES["profilePic"]["type"];

    // Tamaño máximo permitido (en bytes) - 10 MB
    $maxFileSize = 10 * 1024 * 1024;

    // Validar el tamaño del archivo
    if ($profilePicSize > $maxFileSize) {
        http_response_code(400);
        exit("The profile picture size should be less than 10 MB.");
    }

    // Validar el tipo de archivo (solo permitir imágenes)
    $allowedTypes = ["image/jpeg", "image/png", "image/gif"];
    if (!in_array($profilePicType, $allowedTypes)) {
        http_response_code(400);
        exit("Only JPG, PNG, and GIF formats are allowed.");
    }

    // Procesar la imagen de perfil
    list($width, $height) = getimagesize($profilePicTmpName);
    if ($width == 500 || $height == 500) {
        http_response_code(400);
        exit("The image dimensions should be 200x200 pixels.");
    }

    // Leer los datos de la imagen y guardarlos en la base de datos
    $profilePicData = file_get_contents($profilePicTmpName);

    // Consulta preparada para actualizar la foto de perfil del usuario en la tabla
    $sql = "UPDATE users SET profile_picture = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "si", $profilePicData, $userId);

    if (mysqli_stmt_execute($stmt)) {
        http_response_code(200);
        exit("Profile picture updated successfully.");
    } else {
        http_response_code(500);
        exit("Error updating profile picture.");
    }
} else {
    http_response_code(400);
    exit("No image file was provided.");
}
?>
