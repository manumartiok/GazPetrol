<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title','Panel Admin')</title>
  {{-- jquery --}}
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  {{-- tailwind  --}}
  <script src="https://cdn.tailwindcss.com"></script>
  {{-- font awesome  --}}
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Vue -->
   <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>

   <script src="{{ asset('js/vue.js') }}" defer></script>
  <style>
    .sidebar-transition {
      transition: all 0.3s ease-in-out;
    }
    .user-menu {
      display: none;
      position: absolute;
      top: 100%;
      right: 0;
      z-index: 1000;
    }
    .user-menu.active {
      display: block;
    }
  </style>
</head>
<body class="bg-gray-100">
  <div class="flex h-screen">
    @include('layouts.sidebar')
    <div class="flex-1 flex flex-col">
      @include('layouts.navbar')
      <main class="flex-1 overflow-auto p-6">
        @yield('content')
      </main>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
  <script>
    $(document).ready(function() {
      // Toggle Sidebar
      let sidebarOpen = true;

      $('#toggleSidebar').click(function() {
        sidebarOpen = !sidebarOpen;
        
        if (sidebarOpen) {
          $('#sidebar').removeClass('w-0 overflow-hidden').addClass('w-64');
        } else {
          $('#sidebar').removeClass('w-64').addClass('w-0 overflow-hidden');
        }
      });
      
      // Toggle User Menu
      $('#userMenuBtn').click(function(e) {
        e.stopPropagation();
        $('#userMenu').toggleClass('active');
      });

      // Close menu when clicking outside
      $(document).click(function(e) {
        if (!$(e.target).closest('#userMenuBtn, #userMenu').length) {
          $('#userMenu').removeClass('active');
        }
      });

      // Close menu when clicking a link
      $('#userMenu a').click(function() {
        $('#userMenu').removeClass('active');
      });
    });

    /**
 * Habilita el ordenamiento drag & drop en cualquier tabla.
 * @param {string} selector - El selector CSS del tbody (ej: '#galeria-fotos')
 * @param {string} url - La URL a la que se enviará el orden actualizado
 */
function activarOrdenDragDrop(selector, url) {
    const tbody = document.querySelector(selector);
    if (!tbody) return;

    Sortable.create(tbody, {
        animation: 150,
        handle: '.cursor-move',
        onEnd: function () {
            let orden = [];

            document.querySelectorAll(`${selector} tr`).forEach((fila, index) => {
                const letra = String.fromCharCode(65 + index); // A, B, C...
                const nuevaLetra = letra + letra; // AA, BB, CC...

                // actualizar la celda visualmente
                const celdaOrden = fila.querySelector('td:first-child');
                if (celdaOrden) celdaOrden.textContent = nuevaLetra;

                orden.push({
                    id: fila.dataset.id,
                    orden: nuevaLetra
                });
            });

            fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ orden })
            })
            .then(r => r.json())
            .then(() => console.log('Orden actualizado correctamente'))
            .catch(err => console.error('Error al actualizar el orden:', err));
        }
    });
}
  </script>
</body>
</html>