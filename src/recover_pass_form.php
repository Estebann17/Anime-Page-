<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . "/php/connection.php";


include_once 'header.php'; 

// Función para generar un código de recuperación seguro
function generarCodigoRecuperacion()
{
    return bin2hex(random_bytes(16)); // Generar 16 bytes aleatorios y convertirlos en una cadena hexadecimal
}

// Verificar si se enviaron datos mediante POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener el correo electrónico enviado por el formulario de recuperación de contraseña
    $email = $_POST["email"];

    // Validar que el campo de correo electrónico no esté vacío
    if (empty($email)) {
        $errorMensaje = "Please enter your email.";
    } else {
        // Consultar la base de datos para verificar si el correo electrónico está registrado
        $sql = "SELECT * FROM users WHERE usernameOrEmail = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($result && mysqli_num_rows($result) > 0) {
            // El correo electrónico existe en la base de datos, generar el código de recuperación y almacenarlo en la tabla
            $codigoRecuperacion = generarCodigoRecuperacion();
            $sqlUpdate = "UPDATE users SET codigoRecuperacion = ? WHERE usernameOrEmail = ?";
            $stmtUpdate = mysqli_prepare($conn, $sqlUpdate);
            mysqli_stmt_bind_param($stmtUpdate, "ss", $codigoRecuperacion, $email);
            mysqli_stmt_execute($stmtUpdate);

            // Aquí enviarías un correo electrónico al usuario con el código de recuperación.
            // Por simplicidad, no incluiré el código para enviar el correo electrónico en este ejemplo.

            // Redirigir al usuario a una página donde ingrese el código de recuperación.
            header("Location: recovery_code.php");
            exit;
        } else {
            $errorMensaje = "Email not registered.";
        }
    }
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario recuperar contraseña</title>


    <link rel="stylesheet" href="/si/css/normalize.css">
    <link rel="stylesheet" href="/si/css/style.css">
    <link rel="stylesheet" href="/si/css/form.css">

    <!-- FONT AWESOME -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- BOOTSTRAP -->

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
    

  



        <section class="container-form-recovery"> 
            <div id="formularioRecuperar" class="show">
                <h2>Recover Password</h2>
                <form method="post" action="recover_pass_form.php">
                    <input type="email" name="email" placeholder="Enter your email" required>
                    <button type="submit">Submit</button>
                    <a href="#" onclick="ocultarFormularioRecuperar()">Cancel</a>
                </form>
            </div>
        </section>


        <?php include_once 'navbar.php'; ?>

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
     


        <script src="http://localhost/si/src/js/main.js"></script>
        <script src="http://localhost/si/src/js/jquery.js"></script>


</body>
</html>