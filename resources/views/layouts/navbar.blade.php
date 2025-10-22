<nav class="bg-white shadow px-6 py-4 flex justify-between items-center">
  <div class="flex items-center gap-4">
    <button id="toggleSidebar" class="text-gray-600 hover:text-gray-900 transition text-2xl">
      <i class="fas fa-bars"></i>
    </button>
  </div>

  <!-- User Profile Section -->
  <div class="relative">
    <button id="userMenuBtn" class="flex items-center gap-3 hover:bg-gray-100 px-3 py-2 rounded-lg transition">
      <div class="text-right">
        <p class="font-semibold text-gray-800">nombre</p>
        <p class="text-xs text-gray-500">admin</p>
      </div>
      <img src="" 
           alt="Avatar" class="w-10 h-10 rounded-full">
    </button>

    <!-- Dropdown Menu -->
    <div id="userMenu" class="user-menu bg-white border border-gray-200 rounded-lg shadow-lg mt-2 min-w-48">
      <a href="" class="block px-4 py-3 hover:bg-gray-100 transition border-b border-gray-200">
        <i class="fas fa-user mr-2 text-gray-600"></i>
        <span>Mi Perfil</span>
      </a>
      <a href="" class="block px-4 py-3 hover:bg-gray-100 transition border-b border-gray-200">
        <i class="fas fa-cog mr-2 text-gray-600"></i>
        <span>Configuración</span>
      </a>
      <form method="POST" action="" class="m-0">
        @csrf
        <button type="submit" class="w-full text-left block px-4 py-3 hover:bg-red-50 transition text-red-600 border-t border-gray-200">
          <i class="fas fa-sign-out-alt mr-2"></i>
          <span>Cerrar sesión</span>
        </button>
      </form>
    </div>
  </div>
</nav>