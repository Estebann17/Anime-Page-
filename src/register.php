<?php


// Mantener la sesión iniciada
session_start(); 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . "/php/connection.php";


include_once 'header.php'; 

// Función para verificar si el usuario ya está registrado por su nombre de usuario o correo electrónico
function usuarioRegistrado($usernameOrEmail)
{
    global $conn;

    // Escapamos los datos para prevenir inyección de SQL
    $usernameOrEmail = mysqli_real_escape_string($conn, $usernameOrEmail);

    // Consulta para verificar si el usuario ya está registrado
    $sql = "SELECT * FROM users WHERE usernameOrEmail = '$usernameOrEmail'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        // El usuario ya está registrado
        return true;
    }

    // El usuario no está registrado
    return false;
}

// Verificar si se enviaron datos mediante POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos enviados por el formulario
    $usernameOrEmail = $_POST["usernameOrEmail"];
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirmPassword"];
    $profileDetails = $_POST["profileDetails"];

    // Validación de campos obligatorios
    if (empty($usernameOrEmail) || empty($password) || empty($confirmPassword)) {
        $errorMensaje = "All fields are required.";
    } else {
        // Verificar si el usuario ya está registrado
        if (usuarioRegistrado($usernameOrEmail)) {
            $errorMensaje = "Username/Email already registered. Please choose another one.";
        } else {
            // Validación de contraseña y confirmación de contraseña
            if ($password !== $confirmPassword) {
                $errorMensaje = "Passwords do not match.";
            } else {
                // Procesar la imagen de perfil
                if (isset($_FILES["profilePic"]) && $_FILES["profilePic"]["error"] === UPLOAD_ERR_OK) {
                    // Obtener información del archivo
                    $profilePicName = $_FILES["profilePic"]["name"];
                    $profilePicTmpName = $_FILES["profilePic"]["tmp_name"];
                    $profilePicSize = $_FILES["profilePic"]["size"];
                    $profilePicType = $_FILES["profilePic"]["type"];
                    $profilePicData = file_get_contents($profilePicTmpName);

                    // Tamaño máximo permitido (en bytes) - 10 MB
                    $maxFileSize = 10 * 1024 * 1024;

                    // Validar el tamaño del archivo
                    if ($profilePicSize < $maxFileSize || $profilePicSize > $maxFileSize) {
                        $errorMensaje = "The profile picture size should be between 10 MB.";
                    }

                    // Validar el tipo de archivo (solo permitir JPG, PNG y GIF)
                    $allowedTypes = ["image/jpeg", "image/png", "image/gif"];
                    if (!in_array($profilePicType, $allowedTypes)) {
                        $errorMensaje = "Only JPG, PNG, and GIF formats are allowed.";
                    }

                    // Verificar las dimensiones de la imagen (600x600 píxeles)
                    list($width, $height) = getimagesize($profilePicTmpName);
                    if ($width !== 200 || $height !== 200) {
                        $errorMensaje = "The image dimensions should be 600x600 pixels.";
                    }

                    // Redimensionar la imagen a 600x600 píxeles solo si cumple con los requisitos
                    if (!isset($errorMensaje)) {
                        $resizedImage = imagecreatetruecolor(200, 200);
                        switch ($profilePicType) {
                            case "image/jpeg":
                                $sourceImage = imagecreatefromjpeg($profilePicTmpName);
                                break;
                            case "image/png":
                                $sourceImage = imagecreatefrompng($profilePicTmpName);
                                break;
                            case "image/gif":
                                $sourceImage = imagecreatefromgif($profilePicTmpName);
                                break;
                            default:
                                $errorMensaje = "Invalid image format.";
                        }

                        if (!isset($errorMensaje)) {
                            imagecopyresampled($resizedImage, $sourceImage, 0, 0, 0, 0, 200, 200, $width, $height);
                            ob_start();
                            switch ($profilePicType) {
                                case "image/jpeg":
                                    imagejpeg($resizedImage);
                                    break;
                                case "image/png":
                                    imagepng($resizedImage);
                                    break;
                                case "image/gif":
                                    imagegif($resizedImage);
                                    break;
                            }
                            $profilePicData = ob_get_contents();
                            ob_end_clean();
                            imagedestroy($resizedImage);
                            imagedestroy($sourceImage);

                            // Codificar la imagen en base64
                            $profilePicData = base64_encode($profilePicData);
                        }
                    }
                } else {
                    // Si no se cargó una imagen, puedes asignar una imagen predeterminada o dejar el campo como NULL
                    // Ejemplo: $profilePicData = file_get_contents("path/to/default/image.jpg");
                    $profilePicData = null;
                }

                if (!isset($errorMensaje)) {
                    // Las validaciones pasaron, procedemos a almacenar el usuario en la base de datos
                    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                    // Consulta preparada para insertar el nuevo usuario en la tabla
                    $sql = "INSERT INTO users (usernameOrEmail, password, profile_picture, profile_details) VALUES (?, ?, ?, ?)";
                    $stmt = mysqli_prepare($conn, $sql);
                    mysqli_stmt_bind_param($stmt, "ssss", $usernameOrEmail, $hashedPassword, $profilePicData, $profileDetails);

                    if (mysqli_stmt_execute($stmt)) {
                        // Redirigir al usuario a la página de inicio de sesión o mostrar un mensaje de éxito.
                        header("Location: login.php");
                        exit;
                    } else {
                        $errorMensaje = "Error saving data to the database.";
                    }
                }
            }
        }
    }
}

// Mostrar mensajes de error en caso de que ocurran problemas
if (isset($errorMensaje)) {
    echo '<div style="color: red;">' . $errorMensaje . '</div>';
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



      <section>
          <form method="post" action="register_process.php" enctype="multipart/form-data">
              <div class="box-form">
                  <div class="box-text">
                      <div class="text-login">
                          <a href="/si/src/login.php">Sign in</a>
                      </div>
                      <div class="text-register">
                          <a href="/si/src/register.php">Register</a>
                      </div>
                  </div> 
                 

                  <div class="inputs-form"> 
                        <div class="username-input">
                            <input type="text" name="username" placeholder="Username" required>
                        </div>
                        <div class="usernameOrEmail-input">
                            <input type="text" name="usernameOrEmail" placeholder="Username or e-mail" required>
                        </div>
                        <div class="password-input">
                            <input type="password" name="password" placeholder="Password" required pattern=".{6,}" title="Password must be at least 6 characters long">
                        </div>
                        <div class="repeat-password">
                            <input type="password" name="confirmPassword" placeholder="Confirm password" required>
                        </div>
                    </div>
                    
                    <div class="description-user">
                        <textarea id="profileDetails" name="profileDetails" rows="4" cols="50" placeholder="Enter your description"></textarea>
                    </div>
                    <div class="sign-in-button">
                        <button type="submit">Register</button>
                        <a class="register-link" href="/si/src/login.php">Sign In</a>
                    </div>
          </form>
      </section>








        <?php include_once 'navbar.php'; ?>
  
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
     


        <script src="http://localhost/si/src/js/main.js"></script>
        <script src="http://localhost/si/src/js/jquery.js"></script>
  

</body>
</html>