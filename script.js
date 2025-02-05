
    // Agregar el evento de click al menú móvil
    const menuToggle = document.querySelectorAll('.menu-desplegable a');
    menuToggle.forEach(item => {
        item.addEventListener('click', function(event) {
            const subMenu = this.nextElementSibling;
            if (subMenu && subMenu.classList.contains('sub-menu')) {
                // Prevenir que el link se active al hacer click
                event.preventDefault();
                // Alternar la visibilidad del sub-menú
                subMenu.classList.toggle('show');
            }
        });
    });
    
    
    /*<!-- Menú desplegable -->
    <li class="menu-toggle">
      <a href="javascript:void(0);" class="menu-toggle-button">Menú</a>
      <div class="menu-desplegable">
        <a href="CompraCoche.php">Comprar Coche</a>
        <a href="ReservaCoche.php">Vehículos Reservados</a>
        <a href="#">Nosotros</a>
        <a href="#">Contacto</a>
      </div>
    </li>*/