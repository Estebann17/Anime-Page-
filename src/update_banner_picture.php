<?php
// update_banner_picture.php

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
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_FILES["bannerPic"]) && $_FILES["bannerPic"]["error"] === UPLOAD_ERR_OK) {
    $bannerPicTmpName = $_FILES["bannerPic"]["tmp_name"];
    $bannerPicSize = $_FILES["bannerPic"]["size"];
    $bannerPicType = $_FILES["bannerPic"]["type"];

    // Tamaño máximo permitido (en bytes) - 10 MB
    $maxFileSize = 10 * 1024 * 1024;

    // Validar el tamaño del archivo
    if ($bannerPicSize > $maxFileSize) {
        http_response_code(400);
        exit("The banner picture size should be less than 10 MB.");
    }

    // Validar el tipo de archivo (solo permitir imágenes)
    $allowedTypes = ["image/jpeg", "image/png", "image/gif"];
    if (!in_array($bannerPicType, $allowedTypes)) {
        http_response_code(400);
        exit("Only JPG, PNG, and GIF formats are allowed.");
    }

    // Procesar la imagen de banner
    list($width, $height) = getimagesize($bannerPicTmpName);
    // Asegúrate de establecer las dimensiones correctas para el banner (por ejemplo, 500x200 píxeles)
    $expectedWidth = 1200;
    $expectedHeight = 500;
    if ($width == $expectedWidth || $height == $expectedHeight) {
        http_response_code(400);
        exit("The image dimensions should be {$expectedWidth}x{$expectedHeight} pixels.");
    }

    // Leer los datos de la imagen y guardarlos en la base de datos
    $bannerPicData = file_get_contents($bannerPicTmpName);

    // Consulta preparada para actualizar la foto de banner del usuario en la tabla
    $sql = "UPDATE users SET banner_picture = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "si", $bannerPicData, $userId);

    if (mysqli_stmt_execute($stmt)) {
        http_response_code(200);
        exit("Banner picture updated successfully.");
    } else {
        http_response_code(500);
        exit("Error updating banner picture.");
    }
} else {
    http_response_code(400);
    exit("No image file was provided.");
}
?>
