// Agregar el evento de click al menú móvil
const menuToggle = document.querySelectorAll('.menu-desplegable a');
menuToggle.forEach(item => {
    item.addEventListener('click', function(event) {
        const subMenu = this.nextElementSibling;
        
        if (subMenu && subMenu.classList.contains('sub-menu')) {
            // Prevenir que el link se active al hacer click
            event.preventDefault();

            // Cerrar todos los menús abiertos de manera inmediata
            document.querySelectorAll('.menu-desplegable .sub-menu').forEach(menu => {
                menu.classList.remove('show');
                menu.style.display = 'none'; // Cerrar el menú sin transición
            });

            // Abrir el sub-menú del menú actual si no está abierto
            if (subMenu.style.display === 'block') {
                subMenu.style.display = 'none'; // Si está abierto, cerrarlo
            } else {
                subMenu.style.display = 'block'; // Si no está abierto, abrirlo
            }
        }
    });
});
    