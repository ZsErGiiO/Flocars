document.addEventListener("DOMContentLoaded", function () {
    const images = document.querySelectorAll(".carrusel .imagen-carrusel");
    const miniatures = document.querySelectorAll(".miniatura");
    const prevButton = document.querySelector(".prev-btn");
    const nextButton = document.querySelector(".next-btn");
  
    let currentIndex = 0;
  
    // Función para actualizar la imagen principal
    function updateMainImage(index) {
      const newTransform = `translateX(-${index * 100}%)`;
      document.querySelector(".carrusel .carrusel-imagenes").style.transform = newTransform;
  
      // Actualizar miniaturas (resaltar la seleccionada)
      miniatures.forEach((mini, i) => {
        mini.classList.remove("selected"); // Remover la clase de todas las miniaturas
        if (i === index) {
          mini.classList.add("selected"); // Agregar la clase "selected" a la miniatura seleccionada
        }
      });
    }
  
    // Manejo de clics en miniaturas
    miniatures.forEach((mini, index) => {
      mini.addEventListener("click", function () {
        currentIndex = index;  // Cambiar al índice de la miniatura clickeada
        updateMainImage(currentIndex);  // Actualizar la imagen principal
      });
    });
  
    // Función para ir a la imagen anterior
    prevButton.addEventListener("click", function () {
      currentIndex = (currentIndex === 0) ? images.length - 1 : currentIndex - 1;
      updateMainImage(currentIndex);
    });
  
    // Función para ir a la imagen siguiente
    nextButton.addEventListener("click", function () {
      currentIndex = (currentIndex === images.length - 1) ? 0 : currentIndex + 1;
      updateMainImage(currentIndex);
    });
  
    // Inicializar la imagen principal y miniaturas
    updateMainImage(currentIndex);
  });