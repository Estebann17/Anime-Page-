
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
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error updating profile picture.');
        });
    }
}); 