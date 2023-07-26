<?php
// Mantener la sesión iniciada
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . "/php/connection.php";

// Verificar si el usuario está logeado
if (!isset($_SESSION["userId"])) {
    // Si no está logeado, redirigirlo a la página de inicio de sesión
    header("Location: login.php");
    exit;
}

// Obtener el ID del usuario desde la sesión
$userId = $_SESSION["userId"];

// Obtener la información del usuario desde la base de datos
$sql = "SELECT * FROM users WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $userId);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$userData = mysqli_fetch_assoc($result);

// Ahora podemos incluir el archivo header.php, asegurándonos de que la variable $userData esté disponible
include_once 'header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Si</title>

    <link rel="stylesheet" href="/si/css/normalize.css">
    <link rel="stylesheet" href="/si/css/profile.css">
    <link rel="stylesheet" href="/si/css/style.css">
    

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <!-- FUENTE PRINCIPAL --> 
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=PT+Sans&display=swap" rel="stylesheet">

    <!-- SEGUNDA FUENTE --> 
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">

    <!--SWIFFY SLIDER-->
    <link href="https://cdn.jsdelivr.net/npm/swiffy-slider@1.6.0/dist/css/swiffy-slider.min.css" rel="stylesheet" crossorigin="anonymous">
</head>
<body>

                    <section class="container-profile">
                        <div class="banner">
                            <?php
                            // Si el usuario tiene una imagen de banner, mostrarla en la página
                            if ($userData['banner_picture']) {
                                // Obtener la imagen de banner del usuario desde la base de datos
                                $bannerPicData = $userData['banner_picture'];

                                // Decodificar la imagen desde Base64
                                $bannerPicSrc = 'data:image/jpeg;base64,' . base64_encode($bannerPicData);

                                // Mostrar la imagen de banner
                                echo '<img src="' . $bannerPicSrc . '" alt="Banner Image" id="bannerImage">';
                            } else {
                                // Si el usuario no tiene una imagen de banner, mostrar la imagen predeterminada
                                echo '<img src="/si/src/uploads/banner_default.jpg" alt="Default Banner Image" id="bannerImage">';
                            }
                            ?>
                            <label for="bannerPicInput" id="uploadBannerButton">
                                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                                    <style>svg{fill:#ffffff}</style>
                                    <path d="M0 96C0 60.7 28.7 32 64 32H448c35.3 0 64 28.7 64 64V416c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V96zM323.8 202.5c-4.5-6.6-11.9-10.5-19.8-10.5s-15.4 3.9-19.8 10.5l-87 127.6L170.7 297c-4.6-5.7-11.5-9-18.7-9s-14.2 3.3-18.7 9l-64 80c-5.8 7.2-6.9 17.1-2.9 25.4s12.4 13.6 21.6 13.6h96 32H424c8.9 0 17.1-4.9 21.2-12.8s3.6-17.4-1.4-24.7l-120-176zM112 192a48 48 0 1 0 0-96 48 48 0 1 0 0 96z"/>
                                </svg>
                            </label>
                            <input type="file" id="bannerPicInput" name="bannerPic" accept="image/*" class="d-none">
                        </div>


                        <div class="profile-info-container">
                            <div class="profile-info">
                                <div class="profile-avatar">
                                    <label for="profilePicInput" id="uploadButton">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                                            <style>svg{fill:#ffffff}</style>
                                            <path d="M0 96C0 60.7 28.7 32 64 32H448c35.3 0 64 28.7 64 64V416c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V96zM323.8 202.5c-4.5-6.6-11.9-10.5-19.8-10.5s-15.4 3.9-19.8 10.5l-87 127.6L170.7 297c-4.6-5.7-11.5-9-18.7-9s-14.2 3.3-18.7 9l-64 80c-5.8 7.2-6.9 17.1-2.9 25.4s12.4 13.6 21.6 13.6h96 32H424c8.9 0 17.1-4.9 21.2-12.8s3.6-17.4-1.4-24.7l-120-176zM112 192a48 48 0 1 0 0-96 48 48 0 1 0 0 96z"/>
                                        </svg>
                                    </label>
                                    <input type="file" id="profilePicInput" name="profilePic" accept="image/*" class="d-none">
                                    <div class="profile-avatar-image">
                                        <?php
                                        // Si el usuario tiene una imagen de perfil, mostrarla en la página
                                        if ($userData['profile_picture']) {
                                            // Obtener la imagen de perfil del usuario desde la base de datos
                                            $profilePicData = $userData['profile_picture'];

                                            // Decodificar la imagen desde Base64
                                            $profilePicSrc = 'data:image/jpeg;base64,' . base64_encode($profilePicData);

                                            // Mostrar la imagen en el círculo
                                            echo '<img src="' . $profilePicSrc . '" alt="Profile Image" id="profilePicturePreview">';
                                        } else {
                                            // Si el usuario no tiene una imagen de perfil, mostrar una imagen predeterminada
                                            echo '<img src="/si/src/uploads/default_profile.png" alt="Default Profile Image" id="profilePicturePreview">';
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="profile-details">
                                    <h1> <?php echo $userData['username']; ?></h1>
                                    <p class="profile-note"><?php echo $userData['profile_details']; ?></p>           
                                </div>
                                <div class="profile-container">
                                    <!-- Contenedor interno -->
                                    <div class="profile-inner-container">
                                        <a href="#">
                                            <div class="items-profile-container"> 
                                                <svg xmlns="http://www.w3.org/2000/svg" height="1.5em" viewBox="0 0 512 512">
                                                    <path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM369 209L241 337c-9.4 9.4-24.6 9.4-33.9 0l-64-64c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l47 47L335 175c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9z"/>
                                                </svg>
                                            <p class="profile-text">Leído</p>
                                        </a>
                                    </div>
                                    
                                    <div class="items-profile-container"> 
                                        <a href="#">
                                                <svg xmlns="http://www.w3.org/2000/svg" height="1.5em" viewBox="0 0 512 512">
                                                    <path d="M304 48a48 48 0 1 0 -96 0 48 48 0 1 0 96 0zm0 416a48 48 0 1 0 -96 0 48 48 0 1 0 96 0zM48 304a48 48 0 1 0 0-96 48 48 0 1 0 0 96zm464-48a48 48 0 1 0 -96 0 48 48 0 1 0 96 0zM142.9 437A48 48 0 1 0 75 369.1 48 48 0 1 0 142.9 437zm0-294.2A48 48 0 1 0 75 75a48 48 0 1 0 67.9 67.9zM369.1 437A48 48 0 1 0 437 369.1 48 48 0 1 0 369.1 437z"/>
                                                </svg>
                                            <p class="profile-text">Pendiente</p>
                                        </a>
                                    </div>
                                    
                                    <div class="items-profile-container"> 
                                        <a href="#">
                                                <svg xmlns="http://www.w3.org/2000/svg" height="1.5em" viewBox="0 0 576 512">
                                                    <path d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z"/>
                                                </svg>
                                            <p class="profile-text">Siguiendo</p>
                                        </a>
                                    </div>

                                    <div class="items-profile-container"> 
                                        <a href="#">
                                                <svg xmlns="http://www.w3.org/2000/svg" height="1.5em" viewBox="0 0 576 512">
                                                    <path d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z"/>
                                                </svg>
                                            <p class="profile-text">Favorito</p>
                                        </a>
                                    </div>

                                    <div class="items-profile-container"> 
                                        <a href="#">
                                                <svg xmlns="http://www.w3.org/2000/svg" height="1.5em" viewBox="0 0 512 512">
                                                    <path d="M313.4 479.1c26-5.2 42.9-30.5 37.7-56.5l-2.3-11.4c-5.3-26.7-15.1-52.1-28.8-75.2H464c26.5 0 48-21.5 48-48c0-18.5-10.5-34.6-25.9-42.6C497 236.6 504 223.1 504 208c0-23.4-16.8-42.9-38.9-47.1c4.4-7.3 6.9-15.8 6.9-24.9c0-21.3-13.9-39.4-33.1-45.6c.7-3.3 1.1-6.8 1.1-10.4c0-26.5-21.5-48-48-48H294.5c-19 0-37.5 5.6-53.3 16.1L202.7 73.8C176 91.6 160 121.6 160 153.7V192v48 24.9c0 29.2 13.3 56.7 36 75l7.4 5.9c26.5 21.2 44.6 51 51.2 84.2l2.3 11.4c5.2 26 30.5 42.9 56.5 37.7zM32 384H96c17.7 0 32-14.3 32-32V128c0-17.7-14.3-32-32-32H32C14.3 96 0 110.3 0 128V352c0 17.7 14.3 32 32 32z"/>
                                                </svg>
                                            <p class="profile-text">Abandonado</p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                </section>


                <section class="main-container">
                    <!-- Aside del perfil del usuario -->
                    <div class="top-mangas-user">
                        <aside class="profile-sidebar">
                            <div class="top-mangas">
                                <h3>Top Tier</h3>
                                <ul class="manga-list">
                                    <li>
                                        <a href="#">
                                            <img src="/si/src/img/boruto.jpg" alt="Manga 1">
                                                <p>Manga 1</p>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <img src="/si/src/img/bc.jpg" alt="Manga 2">
                                                <p>Manga 2</p>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <img src="/si/src/img/bnha.jpg" alt="Manga 3">
                                                <p>Manga 3</p>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <!-- Sección de insignias -->
                            <div class="user-badges">
                                <h3>Insignias</h3>
                                    <ul class="badge-list">
                                        <li>
                                            <svg xmlns="http://www.w3.org/2000/svg" height="2em" viewBox="0 0 512 512">
                                                <path d="M211 7.3C205 1 196-1.4 187.6 .8s-14.9 8.9-17.1 17.3L154.7 80.6l-62-17.5c-8.4-2.4-17.4 0-23.5 6.1s-8.5 15.1-6.1 23.5l17.5 62L18.1 170.6c-8.4 2.1-15 8.7-17.3 17.1S1 205 7.3 211l46.2 45L7.3 301C1 307-1.4 316 .8 324.4s8.9 14.9 17.3 17.1l62.5 15.8-17.5 62c-2.4 8.4 0 17.4 6.1 23.5s15.1 8.5 23.5 6.1l62-17.5 15.8 62.5c2.1 8.4 8.7 15 17.1 17.3s17.3-.2 23.4-6.4l45-46.2 45 46.2c6.1 6.2 15 8.7 23.4 6.4s14.9-8.9 17.1-17.3l15.8-62.5 62 17.5c8.4 2.4 17.4 0 23.5-6.1s8.5-15.1 6.1-23.5l-17.5-62 62.5-15.8c8.4-2.1 15-8.7 17.3-17.1s-.2-17.3-6.4-23.4l-46.2-45 46.2-45c6.2-6.1 8.7-15 6.4-23.4s-8.9-14.9-17.3-17.1l-62.5-15.8 17.5-62c2.4-8.4 0-17.4-6.1-23.5s-15.1-8.5-23.5-6.1l-62 17.5L341.4 18.1c-2.1-8.4-8.7-15-17.1-17.3S307 1 301 7.3L256 53.5 211 7.3z"/>
                                            </svg>
                                        </li>
                                        <li>
                                            <svg xmlns="http://www.w3.org/2000/svg" height="2em" viewBox="0 0 512 512">
                                                <path d="M211 7.3C205 1 196-1.4 187.6 .8s-14.9 8.9-17.1 17.3L154.7 80.6l-62-17.5c-8.4-2.4-17.4 0-23.5 6.1s-8.5 15.1-6.1 23.5l17.5 62L18.1 170.6c-8.4 2.1-15 8.7-17.3 17.1S1 205 7.3 211l46.2 45L7.3 301C1 307-1.4 316 .8 324.4s8.9 14.9 17.3 17.1l62.5 15.8-17.5 62c-2.4 8.4 0 17.4 6.1 23.5s15.1 8.5 23.5 6.1l62-17.5 15.8 62.5c2.1 8.4 8.7 15 17.1 17.3s17.3-.2 23.4-6.4l45-46.2 45 46.2c6.1 6.2 15 8.7 23.4 6.4s14.9-8.9 17.1-17.3l15.8-62.5 62 17.5c8.4 2.4 17.4 0 23.5-6.1s8.5-15.1 6.1-23.5l-17.5-62 62.5-15.8c8.4-2.1 15-8.7 17.3-17.1s-.2-17.3-6.4-23.4l-46.2-45 46.2-45c6.2-6.1 8.7-15 6.4-23.4s-8.9-14.9-17.3-17.1l-62.5-15.8 17.5-62c2.4-8.4 0-17.4-6.1-23.5s-15.1-8.5-23.5-6.1l-62 17.5L341.4 18.1c-2.1-8.4-8.7-15-17.1-17.3S307 1 301 7.3L256 53.5 211 7.3z"/>
                                            </svg>
                                        </li>
                                        <li>
                                            <svg xmlns="http://www.w3.org/2000/svg" height="2em" viewBox="0 0 512 512">
                                                <path d="M211 7.3C205 1 196-1.4 187.6 .8s-14.9 8.9-17.1 17.3L154.7 80.6l-62-17.5c-8.4-2.4-17.4 0-23.5 6.1s-8.5 15.1-6.1 23.5l17.5 62L18.1 170.6c-8.4 2.1-15 8.7-17.3 17.1S1 205 7.3 211l46.2 45L7.3 301C1 307-1.4 316 .8 324.4s8.9 14.9 17.3 17.1l62.5 15.8-17.5 62c-2.4 8.4 0 17.4 6.1 23.5s15.1 8.5 23.5 6.1l62-17.5 15.8 62.5c2.1 8.4 8.7 15 17.1 17.3s17.3-.2 23.4-6.4l45-46.2 45 46.2c6.1 6.2 15 8.7 23.4 6.4s14.9-8.9 17.1-17.3l15.8-62.5 62 17.5c8.4 2.4 17.4 0 23.5-6.1s8.5-15.1 6.1-23.5l-17.5-62 62.5-15.8c8.4-2.1 15-8.7 17.3-17.1s-.2-17.3-6.4-23.4l-46.2-45 46.2-45c6.2-6.1 8.7-15 6.4-23.4s-8.9-14.9-17.3-17.1l-62.5-15.8 17.5-62c2.4-8.4 0-17.4-6.1-23.5s-15.1-8.5-23.5-6.1l-62 17.5L341.4 18.1c-2.1-8.4-8.7-15-17.1-17.3S307 1 301 7.3L256 53.5 211 7.3z"/>
                                            </svg>
                                        </li>
                                        <li>
                                            <svg xmlns="http://www.w3.org/2000/svg" height="2em" viewBox="0 0 512 512">
                                                <path d="M211 7.3C205 1 196-1.4 187.6 .8s-14.9 8.9-17.1 17.3L154.7 80.6l-62-17.5c-8.4-2.4-17.4 0-23.5 6.1s-8.5 15.1-6.1 23.5l17.5 62L18.1 170.6c-8.4 2.1-15 8.7-17.3 17.1S1 205 7.3 211l46.2 45L7.3 301C1 307-1.4 316 .8 324.4s8.9 14.9 17.3 17.1l62.5 15.8-17.5 62c-2.4 8.4 0 17.4 6.1 23.5s15.1 8.5 23.5 6.1l62-17.5 15.8 62.5c2.1 8.4 8.7 15 17.1 17.3s17.3-.2 23.4-6.4l45-46.2 45 46.2c6.1 6.2 15 8.7 23.4 6.4s14.9-8.9 17.1-17.3l15.8-62.5 62 17.5c8.4 2.4 17.4 0 23.5-6.1s8.5-15.1 6.1-23.5l-17.5-62 62.5-15.8c8.4-2.1 15-8.7 17.3-17.1s-.2-17.3-6.4-23.4l-46.2-45 46.2-45c6.2-6.1 8.7-15 6.4-23.4s-8.9-14.9-17.3-17.1l-62.5-15.8 17.5-62c2.4-8.4 0-17.4-6.1-23.5s-15.1-8.5-23.5-6.1l-62 17.5L341.4 18.1c-2.1-8.4-8.7-15-17.1-17.3S307 1 301 7.3L256 53.5 211 7.3z"/>
                                            </svg>
                                        </li>
                                        <li>
                                            <svg xmlns="http://www.w3.org/2000/svg" height="2em" viewBox="0 0 512 512">
                                                <path d="M211 7.3C205 1 196-1.4 187.6 .8s-14.9 8.9-17.1 17.3L154.7 80.6l-62-17.5c-8.4-2.4-17.4 0-23.5 6.1s-8.5 15.1-6.1 23.5l17.5 62L18.1 170.6c-8.4 2.1-15 8.7-17.3 17.1S1 205 7.3 211l46.2 45L7.3 301C1 307-1.4 316 .8 324.4s8.9 14.9 17.3 17.1l62.5 15.8-17.5 62c-2.4 8.4 0 17.4 6.1 23.5s15.1 8.5 23.5 6.1l62-17.5 15.8 62.5c2.1 8.4 8.7 15 17.1 17.3s17.3-.2 23.4-6.4l45-46.2 45 46.2c6.1 6.2 15 8.7 23.4 6.4s14.9-8.9 17.1-17.3l15.8-62.5 62 17.5c8.4 2.4 17.4 0 23.5-6.1s8.5-15.1 6.1-23.5l-17.5-62 62.5-15.8c8.4-2.1 15-8.7 17.3-17.1s-.2-17.3-6.4-23.4l-46.2-45 46.2-45c6.2-6.1 8.7-15 6.4-23.4s-8.9-14.9-17.3-17.1l-62.5-15.8 17.5-62c2.4-8.4 0-17.4-6.1-23.5s-15.1-8.5-23.5-6.1l-62 17.5L341.4 18.1c-2.1-8.4-8.7-15-17.1-17.3S307 1 301 7.3L256 53.5 211 7.3z"/>
                                            </svg>
                                        </li>
                                        <li>
                                            <svg xmlns="http://www.w3.org/2000/svg" height="2em" viewBox="0 0 512 512">
                                                <path d="M211 7.3C205 1 196-1.4 187.6 .8s-14.9 8.9-17.1 17.3L154.7 80.6l-62-17.5c-8.4-2.4-17.4 0-23.5 6.1s-8.5 15.1-6.1 23.5l17.5 62L18.1 170.6c-8.4 2.1-15 8.7-17.3 17.1S1 205 7.3 211l46.2 45L7.3 301C1 307-1.4 316 .8 324.4s8.9 14.9 17.3 17.1l62.5 15.8-17.5 62c-2.4 8.4 0 17.4 6.1 23.5s15.1 8.5 23.5 6.1l62-17.5 15.8 62.5c2.1 8.4 8.7 15 17.1 17.3s17.3-.2 23.4-6.4l45-46.2 45 46.2c6.1 6.2 15 8.7 23.4 6.4s14.9-8.9 17.1-17.3l15.8-62.5 62 17.5c8.4 2.4 17.4 0 23.5-6.1s8.5-15.1 6.1-23.5l-17.5-62 62.5-15.8c8.4-2.1 15-8.7 17.3-17.1s-.2-17.3-6.4-23.4l-46.2-45 46.2-45c6.2-6.1 8.7-15 6.4-23.4s-8.9-14.9-17.3-17.1l-62.5-15.8 17.5-62c2.4-8.4 0-17.4-6.1-23.5s-15.1-8.5-23.5-6.1l-62 17.5L341.4 18.1c-2.1-8.4-8.7-15-17.1-17.3S307 1 301 7.3L256 53.5 211 7.3z"/>
                                            </svg>
                                        </li>
                                    </ul>
                                </div>
                        </aside>

                        <!-- Contenedor principal de los exhibidores otaku -->
                        <div class="otaku-container">
                            <div class="otaku-exhbitor-container">
                                <h2>Expositor de completista</h2>
                            
                                <!-- Exhibidores otaku -->
                                <article class="otaku-exhibitor">
                                    <div class="img-exhibitor">
                                        <img src="/si/src/img/action-adventure.jpg" alt="Imagen de Fondo">
                                            <div class="medal">
                                                <img src="/si/src/img/medal.png" alt="#">
                                            </div>
                                        <div class="items-exhibitor">
                                            <span>108/108</span>
                                            <p class="chapter-text">Chapters</p>
                                        </div>
                                    </div>
                                </article>
                                
                                <article class="otaku-exhibitor">
                                    <div class="img-exhibitor">
                                        <img src="/si/src/img/action-adventure.jpg" alt="Imagen de Fondo">
                                            <div class="medal">
                                                <img src="/si/src/img/medal.png" alt="#">
                                            </div>
                                        <div class="items-exhibitor">
                                            <span>108/108</span>
                                            <p class="chapter-text">Chapters</p>
                                        </div>
                                    </div>
                                </article>

                                <article class="otaku-exhibitor">
                                    <div class="img-exhibitor">
                                        <img src="/si/src/img/action-adventure.jpg" alt="Imagen de Fondo">
                                            <div class="medal">
                                                <img src="/si/src/img/medal.png" alt="#">
                                            </div>
                                        <div class="items-exhibitor">
                                            <span>108/108</span>
                                            <p class="chapter-text">Chapters</p>
                                        </div>
                                    </div>
                                </article>

                                <article class="otaku-exhibitor">
                                    <div class="img-exhibitor">
                                        <img src="/si/src/img/action-adventure.jpg" alt="Imagen de Fondo">
                                            <div class="medal">
                                                <img src="/si/src/img/medal.png" alt="#">
                                            </div>
                                        <div class="items-exhibitor">
                                            <span>108/108</span>
                                            <p class="chapter-text">Chapters</p>
                                        </div>
                                    </div>
                                </article>

                                <article class="otaku-exhibitor">
                                    <div class="img-exhibitor">
                                        <img src="/si/src/img/action-adventure.jpg" alt="Imagen de Fondo">
                                            <div class="medal">
                                                <img src="/si/src/img/medal.png" alt="#">
                                            </div>
                                        <div class="items-exhibitor">
                                            <span>108/108</span>
                                            <p class="chapter-text">Chapters</p>
                                        </div>
                                    </div>
                                </article>

                                <article class="otaku-exhibitor">
                                    <div class="img-exhibitor">
                                        <img src="/si/src/img/action-adventure.jpg" alt="Imagen de Fondo">
                                            <div class="medal">
                                                <img src="/si/src/img/medal.png" alt="#">
                                            </div>
                                        <div class="items-exhibitor">
                                            <span>108/108</span>
                                            <p class="chapter-text">Chapters</p>
                                        </div>
                                    </div>
                                </article>
                                
                            </div>
                        </div>
                    </div>
                </section>

















        <?php include_once 'navbar.php'; ?>


        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/swiffy-slider@1.6.0/dist/js/swiffy-slider.min.js" crossorigin="anonymous" defer></script>
       

       

        
        <script src="http://localhost/si/src/js/main.js"></script>
        <script src="http://localhost/si/src/js/picture_profile.js"></script>
        <script src="http://localhost/si/src/js/banner_profile.js"></script>
        <script src="http://localhost/si/src/js/jquery.js"></script>
     


</body>    
</html>