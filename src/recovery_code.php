<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . "/php/connection.php";


include_once 'header.php'; 

// Verificar si se enviaron datos mediante POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener el código de recuperación enviado por el formulario
    $codigoRecuperacion = $_POST["codigoRecuperacion"];
    $email = $_POST["email"];

    // Consultar la base de datos para verificar si el código de recuperación es válido
    $sql = "SELECT * FROM users WHERE usernameOrEmail = ? AND codigoRecuperacion = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $email, $codigoRecuperacion);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) > 0) {
        // El código de recuperación es válido, redirigir al usuario a la página de restablecimiento de contraseña
        header("Location: recovery_code.php?email=" . urlencode($email));
        exit;
    } else {
        $errorMensaje = "Invalid recovery code.";
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



        <div class="form-recovery-container">
            <h2>Enter Recovery Code</h2>
            <?php if (isset($errorMensaje)): ?>
                <p class="error-message"><?php echo $errorMensaje; ?></p>
            <?php endif; ?>
            <form method="post" action="recovery_code.php">
                <?php if (isset($_POST['email'])): ?>
                <input type="hidden" name="email" value="<?php echo $_POST['email']; ?>">
                <?php endif; ?>
                <input type="text" name="codigoRecuperacion" placeholder="Enter your recovery code" required>
                <button type="submit">Submit</button>
            </form>
        </div>









        <?php include_once 'navbar.php'; ?>

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
     


        <script src="http://localhost/si/src/js/main.js"></script>
        <script src="http://localhost/si/src/js/jquery.js"></script>

</body>
</html>