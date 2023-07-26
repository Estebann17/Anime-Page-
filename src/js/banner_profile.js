// BANNER PREDETERMINADO Y FUNCION PARA CAMBIARLO


document.addEventListener("DOMContentLoaded", function () {
    const bannerPicInput = document.getElementById('bannerPicInput');
    const bannerImg = document.getElementById('bannerImage');

    // Función para mostrar la imagen seleccionada en la vista previa del banner
    function displayBannerPicture(event) {
        const input = event.target;

        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function (e) {
                bannerImg.src = e.target.result;
                // Actualizar el banner automáticamente al seleccionar una nueva imagen
                updateBannerPicture(input.files[0]);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

    // Event listener para el input de carga de archivos del banner
    bannerPicInput.addEventListener('change', displayBannerPicture);

    // Función para actualizar la foto de banner en el servidor mediante AJAX
    function updateBannerPicture(file) {
        const formData = new FormData();
        formData.append('bannerPic', file);

        fetch('update_banner_picture.php', {
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
            alert('Error updating banner picture.');
        });
    }
});