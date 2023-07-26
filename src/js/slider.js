
// FUNCION SLIDER SECCION LIBRARY

// JavaScript para el slider
const sliderSlide = document.querySelector('.slider-slide');
const sliderImages = document.querySelectorAll('.slider-image');
const sliderControls = document.querySelectorAll('.slider-control');
const sliderRadios = document.querySelectorAll('.slider-radio');

let currentIndex = 0;

// Función para mostrar las imágenes
function showSlide(index) {
    sliderSlide.style.transform = `translateX(-${index * 50}%)`;
    sliderRadios.forEach((radio, i) => {
        radio.classList.toggle('active', i === index);
    });
}

// Event listener para las flechas (controles) del slider
sliderControls.forEach((control) => {
    control.addEventListener('click', () => {
        if (control.classList.contains('prev')) {
            currentIndex = (currentIndex - 1 + sliderImages.length) % sliderImages.length;
        } else if (control.classList.contains('next')) {
            currentIndex = (currentIndex + 1) % sliderImages.length;
        }

        showSlide(currentIndex);
    });
});

// Event listener para los radio buttons del slider
sliderRadios.forEach((radio, i) => {
    radio.addEventListener('click', () => {
        currentIndex = i;
        showSlide(currentIndex);
    });
});

// Mostrar la primera imagen al cargar la página
showSlide(currentIndex);