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
    <link rel="stylesheet" href="/si/css/form.css">
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

    <!--SWIFFY SLIDER-->
    <link href="https://cdn.jsdelivr.net/npm/swiffy-slider@1.6.0/dist/css/swiffy-slider.min.css" rel="stylesheet" crossorigin="anonymous">
</head>
<body>



      
      <section class="section-main">
        <div class="image-container">
          <img class="img-character" src="http://localhost/si/src/img/character-anime.png" alt="Character Anime">
        </div> 
        <div class="items-main">
          <h1>Vive una experiencia única en el mundo animanga</h1>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos, beatae consequuntur est rem, saepe dignissimos laborum vitae dolorem dolorum error quidem dolor</p>
        </div>
        <div class="cards-main">
          <div class="image-container animated-item">
            <img class="image left-image" src="http://localhost/si/src/img/gantz.jpg" alt="Imagen Pequeña 1">
            <div class="text-container">
              <h2 class="title">Tradicional</h2>
              <span class="price">$15</span>
              <p class="paragraph">Todos tus mangas traducidos</p>
            </div>
          </div>
          <div class="image-container animated-item">
            <img class="image middle-image" src="http://localhost/si/src/img/pluto.jpg" alt="Imagen Mediana">
            <div class="text-container">
              <h2 class="title">Todo a color</h2>
              <span class="price">$30</span>
              <p class="paragraph">Todos los paneles a color</p>
            </div>
          </div>
          <div class="image-container animated-item">
            <img class="image right-image" src="http://localhost/si/src/img/one-piece-1.jpg" alt="Imagen Pequeña 3">
            <div class="text-container">
              <h2 class="title">Doblaje</h2>
              <span class="price">$50</span>
              <p class="paragraph">Tus paneles con doblaje</p>
            </div>
          </div>
        </div>

        <div class="alert">
            <div class="body-alert">
              <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                <style>svg{fill:#1c345e}</style>
                <path d="M256 32c14.2 0 27.3 7.5 34.5 19.8l216 368c7.3 12.4 7.3 27.7 .2 40.1S486.3 480 472 480H40c-14.3 0-27.6-7.7-34.7-20.1s-7-27.8 .2-40.1l216-368C228.7 39.5 241.8 32 256 32zm0 128c-13.3 0-24 10.7-24 24V296c0 13.3 10.7 24 24 24s24-10.7 24-24V184c0-13.3-10.7-24-24-24zm32 224a32 32 0 1 0 -64 0 32 32 0 1 0 64 0z"/>
              </svg>
              <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Doloribus suscipit</p>
          </div>
        </div>

      </section>
       <section class="seccion-populares">
        <div class="items-populares">
          <svg xmlns="http://www.w3.org/2000/svg" height="1.5em" viewBox="0 0 576 512">
            <style>svg{fill:#fa0588}</style>
            <path d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z"/>
          </svg>
          <h2>Mangas Populares</h2>
        </div>

        <section class="section-populares">
          <div class="contenedor-mangas">
                <div class="img-manga">
                    <a href="#"><img src="http://localhost/si/src/img/bc.jpg" alt="Black Clover"></a>
                </div>
                  <div class="overlay">
                        <h3>Black Clover</h3>
                        <p>Black Clover sigue la historia de dos chicos, Asta y Yuno, que crecen en un orfanato de la iglesia de Hage, ubicada en el Reino del Trébol.</p>
                        <a href="https://google.com"><button class="play-button">
                          <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 384 512">
                              <style>svg{fill:#fff}</style><path d="M73 39c-14.8-9.1-33.4-9.4-48.5-.9S0 62.6 0 80V432c0 17.4 9.4 33.4 24.5 41.9s33.7 8.1 48.5-.9L361 297c14.3-8.7 23-24.2 23-41s-8.7-32.2-23-41L73 39z"/>
                          </svg>
                      </button>
                      </a>
                </div> 
            </div> 

          <div class="contenedor-mangas">
                <div class="img-manga">
                    <a href="#"><img src="http://localhost/si/src/img/one piece.jpg" alt="One Piece"></a>
                </div>
                  <div class="overlay overlay-1">
                      <h3>One Piece</h3>
                      <p>One Piece narra la historia de un joven llamado Monkey D. Luffy, que inspirado por su amigo pirata Shanks, comienza un viaje para alcanzar su sueño, ser el Rey de los piratas, para lo cual deberá encontrar el tesoro One.</p>
                      <a href="https://google.com"><button class="play-button">
                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 384 512">
                            <style>svg{fill:#fff}</style><path d="M73 39c-14.8-9.1-33.4-9.4-48.5-.9S0 62.6 0 80V432c0 17.4 9.4 33.4 24.5 41.9s33.7 8.1 48.5-.9L361 297c14.3-8.7 23-24.2 23-41s-8.7-32.2-23-41L73 39z"/>
                        </svg>
                    </button>
                  </a>
                </div> 
            </div>

          <div class="contenedor-mangas">
                <div class="img-manga">
                    <a href="#"><img src="http://localhost/si/src/img/bnha.jpg" alt="Boku no Hero Academia"></a>
                </div>
                  <div class="overlay overlay-2">
                      <h3>Boku no Hero</h3>
                      <p>Izuku Midoriya, un chico sin poderes que, aunque nace en una sociedad en la que tener poderes especiales es de lo más normal, tiene su propio sueño de convertirse en un héroe que salve a las personas con una sonrisa en el rostro.</p>
                      <a href="https://google.com"><button class="play-button">
                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 384 512">
                            <style>svg{fill:#fff}</style><path d="M73 39c-14.8-9.1-33.4-9.4-48.5-.9S0 62.6 0 80V432c0 17.4 9.4 33.4 24.5 41.9s33.7 8.1 48.5-.9L361 297c14.3-8.7 23-24.2 23-41s-8.7-32.2-23-41L73 39z"/>
                        </svg>
                    </button>
                  </a>
                </div> 
            </div>
            
          <div class="contenedor-mangas">
                <div class="img-manga">
                    <a href="#"><img src="http://localhost/si/src/img/jjk.jpg" alt="Jujutsu Kaisen"></a>
                </div>
                  <div class="overlay overlay-3">
                      <h3>Jujutsu Kaisen</h3>
                      <p>Nos cuenta la historia de Yuji Itadori, un estudiante de instituto que pasa sus días con sus amigos en el club de ocultismo de su escuela pero todo esto cambiara cuando descubre que los espíritus realmente existen y deberá reunir un objeto para salvar a sus amigos.</p>
                      <a href="https://google.com"><button class="play-button">
                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 384 512">
                            <style>svg{fill:#fff}</style><path d="M73 39c-14.8-9.1-33.4-9.4-48.5-.9S0 62.6 0 80V432c0 17.4 9.4 33.4 24.5 41.9s33.7 8.1 48.5-.9L361 297c14.3-8.7 23-24.2 23-41s-8.7-32.2-23-41L73 39z"/>
                        </svg>
                    </button>
                  </a>
                </div> 
            </div>

          <div class="contenedor-mangas">
                <div class="img-manga">
                    <a href="#"><img src="http://localhost/si/src/img/boruto.jpg" alt="Boruto"></a>
                </div>
                  <div class="overlay overlay-4">
                      <h3>Boruto</h3>
                      <p>Consiste en el spin-off y secuela del manga Naruto de Masashi Kishimoto, su historia narra las aventuras y formación de Boruto Uzumaki, el hijo de Naruto Uzumaki y Hinata Hyūga</p>
                      <a href="https://google.com"><button class="play-button">
                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 384 512">
                            <style>svg{fill:#fff}</style><path d="M73 39c-14.8-9.1-33.4-9.4-48.5-.9S0 62.6 0 80V432c0 17.4 9.4 33.4 24.5 41.9s33.7 8.1 48.5-.9L361 297c14.3-8.7 23-24.2 23-41s-8.7-32.2-23-41L73 39z"/>
                        </svg>
                    </button>
                  </a>
                </div> 
            </div> 

          <div class="contenedor-mangas">
                <div class="img-manga">
                    <a href="#"><img src="http://localhost/si/src/img/snk.jpg" alt="#"></a>
                </div>
                  <div class="overlay overlay-5">
                      <h3>Shingeki no Kyojin</h3>
                      <p>La trama gira en torno a Eren Jaeger quien después de perder a su madre a manos de los titanes, decide unirse al «Ejército de las murallas» junto a su hermana adoptiva y su mejor amigo con el objetivo de vengar la muerte de su madre y destruir a los titanes.</p>
                      <a href="https://google.com"><button class="play-button">
                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 384 512">
                            <style>svg{fill:#fff}</style><path d="M73 39c-14.8-9.1-33.4-9.4-48.5-.9S0 62.6 0 80V432c0 17.4 9.4 33.4 24.5 41.9s33.7 8.1 48.5-.9L361 297c14.3-8.7 23-24.2 23-41s-8.7-32.2-23-41L73 39z"/>
                        </svg>
                    </button>
                  </a>
                </div> 
            </div>
         </section>
  

         <section class="section-generos">
          
            <div class="generos-titulo">
              <h2>Explora tu interés</h2>
            </div>

            <div class="container-cards"> 
              <a href="/drama-romance" class="container-generos">
                <h3>Drama Romance</h3>
                <p>Enjoy the drama feel the sensation</p>
              </a>
              <a href="/action-adventure" class="container-generos action">
                <h3>Action - Adventure</h3>
                <p>Feel the tension during the fight</p>
              </a>
              <a href="/martial-arts" class="container-generos martials">
                <h3>Martial Arts</h3>
                <p>Discover wonders during your adventure</p>
              </a>
              <a href="/sports" class="container-generos sports">
                <h3>Sports</h3>
                <p>Focuses on stories involving sports and other athletic and competitive</p>
              </a>
              <a href="/comedy" class="container-generos comedy">
                <h3>Comedy</h3>
                <p>Immerse, Imagine, and Inspire.</p>
              </a>
              <a href="/horror" class="container-generos horror">
                <h3>Horror</h3>
                <p>Enjoy the feel or fear and scare of manga</p>
              </a>
              <a href="/family" class="container-generos family">
                <h3>Family</h3>
                <p>Feel the harm about family Manga</p>
              </a>
              <a href="/all-genres" class="container-generos all-genres">
                <h3>See all genres manga</h3>
              </a>
            </div>
         </section>
      

         <section class="ultimas-actualizaciones">
              <div class="actualizaciones-titulo">
                <svg xmlns="http://www.w3.org/2000/svg" height="1.5em" viewBox="0 0 448 512">
                  <style>svg{fill:#fff}</style>
                  <path d="M349.4 44.6c5.9-13.7 1.5-29.7-10.6-38.5s-28.6-8-39.9 1.8l-256 224c-10 8.8-13.6 22.9-8.9 35.3S50.7 288 64 288H175.5L98.6 467.4c-5.9 13.7-1.5 29.7 10.6 38.5s28.6 8 39.9-1.8l256-224c10-8.8 13.6-22.9 8.9-35.3s-16.6-20.7-30-20.7H272.5L349.4 44.6z"/>
                </svg>
                <h2>Ultimas Actualizaciones</h2>
              </div>

               <div class="swiffy-slider slider-item-show4  slider-nav-page slider-nav-autoplay" bis_skin_checked="1" data-slider-nav-autoplay-interval="4000">
                    <ul class="slider-container">
                        <li class="">
                            <div id="slide1" bis_skin_checked="1">
                              <div class="last-updates">
                                <div class="card-update">
                                  <div class="box-card-update">
                                    <a href="#"><img src="http://localhost/si/src/img/akametsu.jpg" alt="#"></a>
                                    <div class="likes-container">
                                      <div class="likes">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                                          <style>svg{fill:#fff}</style>
                                          <path d="M47.6 300.4L228.3 469.1c7.5 7 17.4 10.9 27.7 10.9s20.2-3.9 27.7-10.9L464.4 300.4c30.4-28.3 47.6-68 47.6-109.5v-5.8c0-69.9-50.5-129.5-119.4-141C347 36.5 300.6 51.4 268 84L256 96 244 84c-32.6-32.6-79-47.5-124.6-39.9C50.5 55.6 0 115.2 0 185.1v5.8c0 41.5 17.2 81.2 47.6 109.5z"/>
                                        </svg>
                                        <span class="likes-count">123</span>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <p class="anime-title">Akametsu</p>
                              </div>
                            </div>
                        </li>
                        <li class="">
                            <div id="slide1" bis_skin_checked="1">
                              <div class="last-updates">
                                <div class="card-update">
                                  <div class="box-card-update">
                                    <a href="#"><img src="http://localhost/si/src/img/homunculus.jpg" alt="#"></a>
                                    <div class="likes-container">
                                      <div class="likes">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                                          <style>svg{fill:#fff}</style>
                                          <path d="M47.6 300.4L228.3 469.1c7.5 7 17.4 10.9 27.7 10.9s20.2-3.9 27.7-10.9L464.4 300.4c30.4-28.3 47.6-68 47.6-109.5v-5.8c0-69.9-50.5-129.5-119.4-141C347 36.5 300.6 51.4 268 84L256 96 244 84c-32.6-32.6-79-47.5-124.6-39.9C50.5 55.6 0 115.2 0 185.1v5.8c0 41.5 17.2 81.2 47.6 109.5z"/>
                                        </svg>
                                        <span class="likes-count">123</span>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <p class="anime-title">Homunculus</p>
                              </div>
                            </div>
                        </li>
                        <li class="">
                            <div id="slide1" bis_skin_checked="1">
                              <div class="last-uptdates">
                                <div class="card-update">
                                  <div class="box-card-update">
                                    <a href="#"><img src="http://localhost/si/src/img/dorohedoro.jpg" alt="#"></a>
                                    <div class="likes-container">
                                      <div class="likes">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                                          <style>svg{fill:#fff}</style>
                                          <path d="M47.6 300.4L228.3 469.1c7.5 7 17.4 10.9 27.7 10.9s20.2-3.9 27.7-10.9L464.4 300.4c30.4-28.3 47.6-68 47.6-109.5v-5.8c0-69.9-50.5-129.5-119.4-141C347 36.5 300.6 51.4 268 84L256 96 244 84c-32.6-32.6-79-47.5-124.6-39.9C50.5 55.6 0 115.2 0 185.1v5.8c0 41.5 17.2 81.2 47.6 109.5z"/>
                                        </svg>
                                        <span class="likes-count">123</span>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <p class="anime-title">Dorohedoro</p>
                              </div>
                            </div>
                        </li>
                        <li class="">
                            <div id="slide1" bis_skin_checked="1">
                              <div class="last-updates">
                                <div class="card-update">
                                  <div class="box-card-update">
                                    <a href="#"><img src="http://localhost/si/src/img/shoujo-shuumatsu-ryokou.jpg" alt="#"></a>
                                    <div class="likes-container">
                                      <div class="likes">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                                          <style>svg{fill:#fff}</style>
                                          <path d="M47.6 300.4L228.3 469.1c7.5 7 17.4 10.9 27.7 10.9s20.2-3.9 27.7-10.9L464.4 300.4c30.4-28.3 47.6-68 47.6-109.5v-5.8c0-69.9-50.5-129.5-119.4-141C347 36.5 300.6 51.4 268 84L256 96 244 84c-32.6-32.6-79-47.5-124.6-39.9C50.5 55.6 0 115.2 0 185.1v5.8c0 41.5 17.2 81.2 47.6 109.5z"/>
                                        </svg>
                                        <span class="likes-count">123</span>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <p class="anime-title">Shoujo Shuumatsu Ryokou </p>
                              </div>
                            </div>
                        </li>
                        <li class="">
                            <div id="slide1" bis_skin_checked="1">
                              <div class="last-updates">
                                <div class="card-update">
                                  <div class="box-card-update">
                                    <a href="#"><img src="http://localhost/si/src/img/solanin.jpg" alt="#"></a>
                                    <div class="likes-container">
                                      <div class="likes">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                                          <style>svg{fill:#fff}</style>
                                          <path d="M47.6 300.4L228.3 469.1c7.5 7 17.4 10.9 27.7 10.9s20.2-3.9 27.7-10.9L464.4 300.4c30.4-28.3 47.6-68 47.6-109.5v-5.8c0-69.9-50.5-129.5-119.4-141C347 36.5 300.6 51.4 268 84L256 96 244 84c-32.6-32.6-79-47.5-124.6-39.9C50.5 55.6 0 115.2 0 185.1v5.8c0 41.5 17.2 81.2 47.6 109.5z"/>
                                        </svg>
                                        <span class="likes-count">123</span>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <p class="anime-title">Solanin</p>
                              </div>
                            </div>
                        </li>
                        <li class="">
                            <div id="slide1" bis_skin_checked="1">
                              <div class="last-updates">
                                <div class="card-update">
                                  <div class="box-card-update">
                                    <a href="#"><img src="http://localhost/si/src/img/innocent.png" alt="#"></a>
                                    <div class="likes-container">
                                      <div class="likes">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                                          <style>svg{fill:#fff}</style>
                                          <path d="M47.6 300.4L228.3 469.1c7.5 7 17.4 10.9 27.7 10.9s20.2-3.9 27.7-10.9L464.4 300.4c30.4-28.3 47.6-68 47.6-109.5v-5.8c0-69.9-50.5-129.5-119.4-141C347 36.5 300.6 51.4 268 84L256 96 244 84c-32.6-32.6-79-47.5-124.6-39.9C50.5 55.6 0 115.2 0 185.1v5.8c0 41.5 17.2 81.2 47.6 109.5z"/>
                                        </svg>
                                        <span class="likes-count">123</span>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <p class="anime-title">Innocent</p>
                              </div>
                            </div>
                        </li>
                        <li class="">
                            <div id="slide1" bis_skin_checked="1">
                              <div class="last-updates">
                                <div class="card-update">
                                  <div class="box-card-update">
                                    <a href="#"><img src="http://localhost/si/src/img/innocent.png" alt="#"></a>
                                    <div class="likes-container">
                                      <div class="likes">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                                          <style>svg{fill:#fff}</style>
                                          <path d="M47.6 300.4L228.3 469.1c7.5 7 17.4 10.9 27.7 10.9s20.2-3.9 27.7-10.9L464.4 300.4c30.4-28.3 47.6-68 47.6-109.5v-5.8c0-69.9-50.5-129.5-119.4-141C347 36.5 300.6 51.4 268 84L256 96 244 84c-32.6-32.6-79-47.5-124.6-39.9C50.5 55.6 0 115.2 0 185.1v5.8c0 41.5 17.2 81.2 47.6 109.5z"/>
                                        </svg>
                                        <span class="likes-count">123</span>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <p class="anime-title">Innocent</p>
                              </div>
                            </div>
                        </li>
                        <li class="">
                            <div id="slide1" bis_skin_checked="1">
                              <div class="last-updates">
                                <div class="card-update">
                                  <div class="box-card-update">
                                    <a href="#"><img src="http://localhost/si/src/img/innocent.png" alt="#"></a>
                                    <div class="likes-container">
                                      <div class="likes">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                                          <style>svg{fill:#fff}</style>
                                          <path d="M47.6 300.4L228.3 469.1c7.5 7 17.4 10.9 27.7 10.9s20.2-3.9 27.7-10.9L464.4 300.4c30.4-28.3 47.6-68 47.6-109.5v-5.8c0-69.9-50.5-129.5-119.4-141C347 36.5 300.6 51.4 268 84L256 96 244 84c-32.6-32.6-79-47.5-124.6-39.9C50.5 55.6 0 115.2 0 185.1v5.8c0 41.5 17.2 81.2 47.6 109.5z"/>
                                        </svg>
                                        <span class="likes-count">123</span>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <p class="anime-title">Innocent</p>
                              </div>
                            </div>
                        </li>
                        <li class="">
                            <div id="slide1" bis_skin_checked="1">
                              <div class="last-updates">
                                <div class="card-update">
                                  <div class="box-card-update">
                                    <a href="#"><img src="http://localhost/si/src/img/innocent.png" alt="#"></a>
                                    <div class="likes-container">
                                      <div class="likes">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                                          <style>svg{fill:#fff}</style>
                                          <path d="M47.6 300.4L228.3 469.1c7.5 7 17.4 10.9 27.7 10.9s20.2-3.9 27.7-10.9L464.4 300.4c30.4-28.3 47.6-68 47.6-109.5v-5.8c0-69.9-50.5-129.5-119.4-141C347 36.5 300.6 51.4 268 84L256 96 244 84c-32.6-32.6-79-47.5-124.6-39.9C50.5 55.6 0 115.2 0 185.1v5.8c0 41.5 17.2 81.2 47.6 109.5z"/>
                                        </svg>
                                        <span class="likes-count">123</span>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <p class="anime-title">Innocent</p>
                              </div>
                            </div>
                        </li>
                        <li class="">
                            <div id="slide1" bis_skin_checked="1">
                              <div class="last-updates">
                                <div class="card-update">
                                  <div class="box-card-update">
                                    <a href="#"><img src="http://localhost/si/src/img/innocent.png" alt="#"></a>
                                    <div class="likes-container">
                                      <div class="likes">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                                          <style>svg{fill:#fff}</style>
                                          <path d="M47.6 300.4L228.3 469.1c7.5 7 17.4 10.9 27.7 10.9s20.2-3.9 27.7-10.9L464.4 300.4c30.4-28.3 47.6-68 47.6-109.5v-5.8c0-69.9-50.5-129.5-119.4-141C347 36.5 300.6 51.4 268 84L256 96 244 84c-32.6-32.6-79-47.5-124.6-39.9C50.5 55.6 0 115.2 0 185.1v5.8c0 41.5 17.2 81.2 47.6 109.5z"/>
                                        </svg>
                                        <span class="likes-count">123</span>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <p class="anime-title">Innocent</p>
                              </div>
                            </div>
                        </li>
                    </ul>
                </div> 
         </section>


         <!-- SECCION FAQ -->

         <section class="faq section-padding section-faq">
          <div class="container">
            <div class="row justify-content-center">
              <div class="col-lg-8 text-center">
                <div class="section-title">
                  <h2>FAQ</h2>
                </div>
              </div>
            </div>
            <div class="row d-flex justify-content-center">
              <div class="col-lg-6">
                <div id="accordion-1">
                  <div class="accordion-item">
                    <div class="accordion-header collapsed" data-bs-toggle="collapse" data-bs-target="#collapse-01">
                      <h3>Pregunta 1</h3>
                      <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                      </svg>
                    </div>
                    <div class="collapse" id="collapse-01" data-bs-parent="#accordion-1">
                      <div class="accordion-body">
                        <p>Lorem ipsum dolor sit amet, cumque recusandae ut illum accusantium repellat a
                          nimi dolores vitae, tenetur officiis. Nam, est dolorem!</p>
                      </div>
                    </div>
                  </div>
        
                  <div class="accordion-item">
                    <div class="accordion-header collapsed" data-bs-toggle="collapse" data-bs-target="#collapse-02">
                      <h3>Pregunta 2</h3>
                      <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                      </svg>
                    </div>
                    <div class="collapse" id="collapse-02" data-bs-parent="#accordion-1">
                      <div class="accordion-body">
                        <p>Lorem ipsum dolor sit amet, cumque recusandae ut illum accusantium repellat a
                          nimi dolores vitae, tenetur officiis. Nam, est dolorem!</p>
                      </div>
                    </div>
                  </div>
        
                  <div class="accordion-item">
                    <div class="accordion-header collapsed" data-bs-toggle="collapse" data-bs-target="#collapse-03">
                      <h3>Pregunta 3</h3>
                      <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                      </svg>
                    </div>
                    <div class="collapse" id="collapse-03" data-bs-parent="#accordion-1">
                      <div class="accordion-body">
                        <p>Lorem ipsum dolor sit amet, cumque recusandae ut illum accusantium repellat a
                          nimi dolores vitae, tenetur officiis. Nam, est dolorem!</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>



        <?php include_once 'navbar.php'; ?>


        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/swiffy-slider@1.6.0/dist/js/swiffy-slider.min.js" crossorigin="anonymous" defer></script>
       


        <script src="http://localhost/si/src/js/main.js"></script>
        <script src="http://localhost/si/src/js/jquery.js"></script>
     

</body>
</html>