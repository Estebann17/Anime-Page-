const questions = document.getElementsByClassName('question');

for (const question of questions) {
  question.addEventListener('click', function() {
    const answer = this.nextElementSibling;
    answer.classList.toggle('show');
  });
}

/* Menu Funcion */
function menuShow() {
  let menuMobile = document.querySelector('.mobile-menu');
  if (menuMobile.classList.contains('open')) {
      menuMobile.classList.remove('open');
      document.querySelector('.icon').src = "http://localhost/si/src/img/menu.png";
  } else {
      menuMobile.classList.add('open');
      document.querySelector('.icon').src = "http://localhost/si/src/img/close.png";
  }
}


// Esperar a que el DOM se cargue completamente
document.addEventListener("DOMContentLoaded", function () {
    const profilePicInput = document.getElementById('profilePicInput');
    const imgPreview = document.getElementById('profilePicturePreview');

    // Función para mostrar la imagen seleccionada en la vista previa del avatar
    function displayProfilePicture(event) {
        const input = event.target;

        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function (e) {
                imgPreview.src = e.target.result;
                // Actualizar la imagen de perfil automáticamente al seleccionar una nueva imagen
                updateProfilePicture(input.files[0]);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

    // Event listener para el input de carga de archivos en el formulario
    profilePicInput.addEventListener('change', displayProfilePicture);

    // Función para actualizar la foto de perfil en el servidor mediante AJAX
    function updateProfilePicture(file) {
        const formData = new FormData();
        formData.append('profilePic', file);

        fetch('update_profile_picture.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            // Mostrar mensaje de éxito o error
            alert(data);
            // Si la actualización fue exitosa, también actualizamos la imagen de perfil mostrada en la página.
            if (data === "Profile picture updated successfully.") {
                imgPreview.src = URL.createObjectURL(file);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error updating profile picture.');
        });
    }
});


// FUNCION RECUPERAR CONTRASEÑA FORMULARIO

function ocultarFormularioRecuperar() {
  const formularioRecuperar = document.getElementById('formularioRecuperar');
  formularioRecuperar.classList.remove('show');
}

document.addEventListener("DOMContentLoaded", function () {
  const recuperarLink = document.querySelector(".recuperar-link");
  const formularioRecuperar = document.getElementById("formularioRecuperar");

  if (recuperarLink && formularioRecuperar) {
      recuperarLink.addEventListener("click", function (event) {
          event.preventDefault();
          formularioRecuperar.classList.add("show");
      });
  }
});














/* Función para mostrar la imagen seleccionada en la vista previa del avatar
function displayProfilePicture(event) {
    const input = event.target;
    const imgPreview = document.getElementById('profilePicturePreview');
    const svgText = document.getElementById('profilePictureText');

    if (input.files && input.files[0]) {
        const reader = new FileReader();

        reader.onload = function (e) {
            imgPreview.src = e.target.result;
            svgText.setAttribute('visibility', 'hidden'); // Ocultar el texto cuando hay una imagen seleccionada
        };

        reader.readAsDataURL(input.files[0]);
    } else {
        imgPreview.src = "/path/to/default/image.jpg"; // Restaurar la imagen predeterminada
        svgText.setAttribute('visibility', 'visible'); // Mostrar el texto cuando no hay imagen seleccionada
    }
}

const profilePicInput = document.getElementById('profilePicInput');
const uploadButtonRegister = document.getElementById('uploadButtonRegister');
const profilePicInputRegister = document.getElementById('profilePicInputRegister');

// Event listener para ambos botones
profilePicInput.addEventListener('change', displayProfilePicture);
uploadButtonRegister.addEventListener('click', function () {
    profilePicInputRegister.click();
}); */

