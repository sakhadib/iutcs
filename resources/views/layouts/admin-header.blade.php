<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0"
    />
    <title>IUTCS | IUT Computer Society</title>

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
    {{-- End Bootstrap --}}

    {{-- Utility CSS --}}
    <link rel="stylesheet" href="/css/util.css">
    {{-- End Utility CSS --}}

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <style type="text/tailwindcss">
      @theme {
        --color-navy: #0a1929;
        --color-red: #e63946;
        --color-cyan: #00a8e8;
      }
    </style>
    <link
      rel="stylesheet"
      href="./home.css"
    />
    <link
      rel="stylesheet"
      href="./global.css"
    />
  </head>
  <body>
  <header class="bg-navy sticky text-white top-0 z-50 shadow-md px-4 py-6">
    <div class="container mx-auto">
    <div class="flex justify-between items-center">
      <a href="/">
        <img src="/rsx/logo.svg" alt="" style="width:70px">
      </a>
      <!-- Mobile menu toggle button -->
      <button id="mobile-menu-button" class="md:hidden focus:outline-none">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          class="h-6 w-6 text-white"
          fill="none"
          viewBox="0 0 24 24"
          stroke="currentColor"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M4 6h16M4 12h16m-7 6h7"
          />
        </svg>
      </button>
      <nav class="hidden md:flex items-center gap-x-6">
      <a href="/home" class="nav-link py-2 hover:text-cyan transition-colors">Home</a>
      <a href="/fests" class="nav-link py-2 hover:text-cyan transition-colors">Fests</a>
      <a href="/teams" class="nav-link py-2 hover:text-cyan transition-colors">Teams</a>
      @if(session('role') == 'admin')
      <a href="/admin/users" class="nav-link py-2 hover:text-cyan transition-colors">Users</a>
      @endif
      <a href="/about" class="nav-link py-2 hover:text-cyan transition-colors">About</a>
      <div class="flex items-center space-x-4 ml-6">
        <a href="/profile/{{ session('user_id') }}" class="nav-link py-2 hover:text-cyan transition-colors">
        {{ collect(explode(' ', session('user_name')))->take(2)->implode(' ') }}
        </a>
        <a href="/logout" class="bg-transparent border-2 border-cyan hover:bg-cyan/10 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors">
        Logout
        </a>
      </div>
      </nav>
    </div>
    <!-- Mobile menu: hidden by default and toggled via button -->
    <nav id="mobile-menu" class="mt-4 flex-col gap-y-4 hidden md:hidden">
      <a href="/home" class="block nav-link py-2 hover:text-cyan transition-colors">Home</a>
      <a href="/fests" class="block nav-link py-2 hover:text-cyan transition-colors">Fests</a>
      <a href="/teams" class="block nav-link py-2 hover:text-cyan transition-colors">Teams</a>
      @if(session('role') == 'admin')
      <a href="/admin/users" class="nav-link py-2 hover:text-cyan transition-colors">Users</a>
      @endif
      <a href="/about" class="block nav-link py-2 hover:text-cyan transition-colors">About</a>
      <div class="flex flex-col items-start space-y-2 ml-0">
      <a href="/profile/{{ session('user_id') }}" class="nav-link py-2 hover:text-cyan transition-colors">
        {{ collect(explode(' ', session('user_name')))->take(2)->implode(' ') }}
      </a>
      <a href="/logout" class="bg-transparent border-2 border-cyan hover:bg-cyan/10 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors">
        Logout
      </a>
      </div>
    </nav>
    </div>
  </header>
  <script>
    document.getElementById('mobile-menu-button').addEventListener('click', function() {
    var mobileMenu = document.getElementById('mobile-menu');
    mobileMenu.classList.toggle('hidden');
    });
  </script>
