<?php

// Mantener la sesión iniciada

session_start(); 

// Incluye el archivo de conexión
require_once __DIR__ . "/php/connection.php";

include_once 'header.php'; 

// Realiza una consulta de prueba para verificar la conexión
$sql = "SELECT * FROM Mangas LIMIT 1";
$result = mysqli_query($conn, $sql);

if ($result) {
    echo "";
} else {
    echo "Error al conectar con la base de datos: " . mysqli_error($conn);
}

// Cierra la conexión
mysqli_close($conn);
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Si</title>

    <link rel="stylesheet" href="/si/css/normalize.css">
    <link rel="stylesheet" href="/si/css/style.css">
    <link rel="stylesheet" href="/si/css/library.css">
    <link rel="stylesheet" href="/si/css/profile.css">
    
     

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

</head>
<body>


       
        

        <?php include_once 'slider_locked.php'; ?>



        <?php include_once 'card_unlocked.php'; ?>

    

        <?php include_once 'card_locked.php'; ?>



        <?php include_once 'navbar.php'; ?>


        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>



        <script src="http://localhost/si/src/js/main.js"></script>
        <script src="http://localhost/si/src/js/slider.js"></script>
        <script src="http://localhost/si/src/js/jquery.js"></script>


</body>
</html>