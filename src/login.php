<?php

// Evitar que la página se almacene en caché

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require_once __DIR__ . "/php/connection.php";


include_once 'header.php'; 

// Función para verificar las credenciales del usuario en la base de datos
function verificarCredenciales($usernameOrEmail, $password)
{
    global $conn;

    // Escapamos los datos para prevenir inyección de SQL
    $usernameOrEmail = mysqli_real_escape_string($conn, $usernameOrEmail);

    // Consulta para obtener el registro del usuario por su nombre de usuario o correo electrónico
    $sql = "SELECT * FROM users WHERE usernameOrEmail = '$usernameOrEmail'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        // Verificamos la contraseña
        if (password_verify($password, $user['password'])) {
            // Las credenciales son válidas
            return $user['id']; // Devolver el ID del usuario encontrado
        }
    }

    // Las credenciales son inválidas o el usuario no existe
    return false;
}

// Verificar si se enviaron datos mediante POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos enviados por el formulario
    $usernameOrEmail = $_POST["usernameOrEmail"];
    $password = $_POST["password"];

    // Validación de campos obligatorios
    if (empty($usernameOrEmail) || empty($password)) {
        $errorMensaje = "Username/Email and password are required.";
    } else {
        // Verificar las credenciales en la base de datos
        $userId = verificarCredenciales($usernameOrEmail, $password);
        if ($userId !== false) {
            // Iniciar sesión y almacenar el ID del usuario en la sesión
            $_SESSION["userId"] = $userId;
            header("Location: profile.php"); // Redirigir al perfil del usuario
            exit;
        } else {
            $errorMensaje = "Invalid credentials";
        }
    }
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Si</title>

    <link rel="stylesheet" href="/si/css/normalize.css">
    <link rel="stylesheet" href="/si/css/style.css">
    <link rel="stylesheet" href="/si/css/form.css">
     

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
  


  
<div class="container">
        <section class="login-form-section">
            <form method="post" action="login_process.php" class="login-form">
                <div class="box-form">
                    <div class="box-text">
                        <div class="text-login">
                            <a href="/si/src/profile.php" onclick="toggleColors()">Sign in</a>
                        </div>
                        <div class="text-register">
                            <a href="/si/src/register.php" onclick="toggleColors()">Register</a>
                        </div>
                    </div>
                    <div class="inputs-form">
                        <div class="form-fields-container"> 
                            <input type="text" name="usernameOrEmail" placeholder="Username or e-mail">
                            <input type="password" name="password" placeholder="Password">
                        </div>
                        <div class="recover-password">
                            <a href="recover_pass_form.php" class="recuperar-link">Forgot your password? Click here</a>
                        </div>

                        <!-- Código para mostrar el mensaje de error -->
                        <?php if (isset($errorMensaje) && !empty($errorMensaje)) : ?>
                            <div class="error-message">
                                <?php echo $errorMensaje; ?>
                            </div>
                        <?php endif; ?>
                        <!-- Fin del código para mostrar el mensaje de error -->
                        
                    </div>
                    <div class="sign-in-button">
                        <button type="submit">Sign In</button>
                        <a class="register-link" href="/si/src/register.php">Register</a>
                    </div>
                </div>
            </form>
        </section>
        
    </div>





      

    <?php include_once 'navbar.php'; ?> <!-- Incluir el navbar después del formulario -->
  
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
     


        <script src="http://localhost/si/src/js/main.js"></script>
        <script src="http://localhost/si/src/js/jquery.js"></script>

     
</body>
</html>