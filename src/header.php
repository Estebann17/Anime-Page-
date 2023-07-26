<?php
// header.php


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Verificar si el usuario está logeado y obtener los datos del usuario
$userData = [];
if (isset($_SESSION["userId"])) {
    // Obtener el ID del usuario desde la sesión
    $userId = $_SESSION["userId"];

    // Obtener la información del usuario desde la base de datos
    $sql = "SELECT * FROM users WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $userId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $userData = mysqli_fetch_assoc($result);
}
?>

    <main>
  <section class="seccion-principal">
    <header>
      <nav class="nav-bar">
        <div class="logo-menu">
          <div class="logo">
            <a href="/si/src/index.php"><span>Logo</span></a>
          </div>
          <div class="nav-list">
            <ul>
              <li class="nav-item"><a href="/si/src/library.php" class="nav-link">Library</a></li>
              <li class="nav-item"><a href="#" class="nav-link">Genres</a></li>
              <li class="nav-item"><a href="#" class="nav-link">Popular</a></li>
              <li class="nav-item"><a href="#" class="nav-link">Socials</a></li>
              <li class="nav-item"><a href="#" class="nav-link">Faq</a></li>
              <li class="nav-item"><a href="#" class="nav-link">+18</a></li>
            </ul>
          </div>
        </div>
        
        <div class="search-container">
          <form class="input-search">
            <input type="search" placeholder="Busca tu manga favorito">
            <button type="submit">
              <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                <style>svg { fill: #fff; }</style>
                <path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"/>
              </svg>
            </button>
          </form>
        </div>


          <div class="login-container">
              <div class="login">
                  <div class="settings-icon">
                      <div class="btn-group">
                          <?php if (isset($_SESSION["userId"])) : ?>
                              <?php if (isset($userData['profile_picture']) && !empty($userData['profile_picture'])) : ?>
                                  <?php
                                  // Obtener la imagen de perfil del usuario desde la base de datos
                                  $profilePicData = $userData['profile_picture'];
                                  $profilePicSrc = 'data:image/jpeg;base64,' . base64_encode($profilePicData);
                                  ?>
                                  <div class="profile-avatar-container">
                                      <div class="profile-avatar-image">
                                          <a href="/si/src/profile.php"><img src="<?php echo $profilePicSrc; ?>" alt="Profile Image" id="profilePicturePreview" class="avatar-image"></a>
                                      </div>
                                  </div>
                              <?php else : ?>
                                  <!-- Si el usuario no tiene una imagen de perfil, mostrar una imagen predeterminada -->
                                  <div class="profile-avatar-container">
                                      <div class="profile-avatar-image">
                                          <img src="/si/src/uploads/default_profile.png" alt="Default Profile Image" id="profilePicturePreview" class="avatar-image">
                                      </div>
                                  </div>
                              <?php endif; ?>
                              <a href="/si/src/logout.php">
                                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                                  <path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z"/>
                                </svg>
                              </a>
                          <?php else : ?>
                              <a href="/si/src/register.php">
                                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512">
                                <path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z"/>
                                </svg>
                              </a>
                          <?php endif; ?>
                      </div>
                  </div>
              </div>
          </div>



        <div class="mobile-menu-icon">
          <button onclick="menuShow()"><img class="icon" src="http://localhost/si/src/img/menu.png" alt=""></button>
        </div>
      </nav>
      <div class="mobile-menu">
        <form class="input-search">
          <input type="search" placeholder="Busca tu manga favorito">
          <button type="submit">
            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
              <style>svg { fill: #fff; }</style>
              <path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"/>
            </svg>
          </button>
        </form>
        <ul>
          <li class="nav-item"><a href="#" class="nav-link">Genres</a></li>
          <li class="nav-item"><a href="#" class="nav-link">Popular</a></li>
          <li class="nav-item"><a href="#" class="nav-link">Socials</a></li>
          <li class="nav-item"><a href="#" class="nav-link">Faq</a></li>
          <li class="nav-item"><a href="#" class="nav-link">+18</a></li>
        </ul>
        <div class="login-discord">
          <div class="login">
          <div class="settings-icon">
                    <a href="/si/src/login.php" target="_blank">
                      <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                        <style>svg{fill:#657ca4}</style>
                        <path d="M495.9 166.6c3.2 8.7 .5 18.4-6.4 24.6l-43.3 39.4c1.1 8.3 1.7 16.8 1.7 25.4s-.6 17.1-1.7 25.4l43.3 39.4c6.9 6.2 9.6 15.9 6.4 24.6c-4.4 11.9-9.7 23.3-15.8 34.3l-4.7 8.1c-6.6 11-14 21.4-22.1 31.2c-5.9 7.2-15.7 9.6-24.5 6.8l-55.7-17.7c-13.4 10.3-28.2 18.9-44 25.4l-12.5 57.1c-2 9.1-9 16.3-18.2 17.8c-13.8 2.3-28 3.5-42.5 3.5s-28.7-1.2-42.5-3.5c-9.2-1.5-16.2-8.7-18.2-17.8l-12.5-57.1c-15.8-6.5-30.6-15.1-44-25.4L83.1 425.9c-8.8 2.8-18.6 .3-24.5-6.8c-8.1-9.8-15.5-20.2-22.1-31.2l-4.7-8.1c-6.1-11-11.4-22.4-15.8-34.3c-3.2-8.7-.5-18.4 6.4-24.6l43.3-39.4C64.6 273.1 64 264.6 64 256s.6-17.1 1.7-25.4L22.4 191.2c-6.9-6.2-9.6-15.9-6.4-24.6c4.4-11.9 9.7-23.3 15.8-34.3l4.7-8.1c6.6-11 14-21.4 22.1-31.2c5.9-7.2 15.7-9.6 24.5-6.8l55.7 17.7c13.4-10.3 28.2-18.9 44-25.4l12.5-57.1c2-9.1 9-16.3 18.2-17.8C227.3 1.2 241.5 0 256 0s28.7 1.2 42.5 3.5c9.2 1.5 16.2 8.7 18.2 17.8l12.5 57.1c15.8 6.5 30.6 15.1 44 25.4l55.7-17.7c8.8-2.8 18.6-.3 24.5 6.8c8.1 9.8 15.5 20.2 22.1 31.2l4.7 8.1c6.1 11 11.4 22.4 15.8 34.3zM256 336a80 80 0 1 0 0-160 80 80 0 1 0 0 160z"/>
                      </svg>
                    </a>
                  </div>
            <div class="person-icon">
              <a href="/si/src/login.php" target="_blank">
                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512">
                  <style>svg { fill: #ffffff; }</style>
                  <path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z"/>
                </svg>
              </a>
            </div>
          </div>
          <button><a href="#">Discord</a></button>
        </div>
      </div>
    </header>
  </section>
</main>