<?php
// Datos de conexión a la base de datos

$servername = "localhost";  // Nombre del servidor (puede ser "localhost" en la mayoría de los casos)
$username = "admin_estbxn";  // Nombre de usuario de MySQL
$password = "mBXXMOckiENCsqF2PBVvS57019012094701894_Ee!";  // Contraseña de MySQL
$database = "manga_db";  // Nombre de la base de datos que creaste

// Establecer la conexión con la base de datos
$conn = mysqli_connect($servername, $username, $password, $database);

// Verificar la conexión
if (!$conn) {
    die("La conexión falló: " . mysqli_connect_error());
}
?>
   