<?php
// Incluye el archivo de conexión
require_once __DIR__ . "/../php/connection.php";

// Recibe los datos del formulario (este es solo un ejemplo, debes adaptarlo según tus necesidades)
$titulo = "Título del manga";
$autor = "Nombre del autor";
$genero = "Género del manga";
$calificacion = 9.5;
$estado_publicacion = "Publicado";
$num_capitulos = 100;

// Crea la consulta para insertar los datos en la tabla Mangas
$sql = "INSERT INTO Mangas (titulo, autor, genero, calificacion, estado_publicacion, num_capitulos) VALUES ('$titulo', '$autor', '$genero', $calificacion, '$estado_publicacion', $num_capitulos)";

// Ejecuta la consulta
if (mysqli_query($conn, $sql)) {
    echo "El manga se ha insertado correctamente en la base de datos.";
} else {
    echo "Error al insertar el manga: " . mysqli_error($conn);
}

// Cierra la conexión
mysqli_close($conn);
?>
