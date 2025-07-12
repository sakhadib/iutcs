    <header class="bg-navy/80 backdrop-blur-lg backdrop-saturate-150 sticky text-white top-0 z-50 shadow-xl border-b border-white/10 px-4 py-6">
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
          <nav class="hidden md:flex flex items-center gap-x-6">
            <a
              href="/home"
              class="nav-link py-2 hover:text-cyan transition-colors"
            >
              Home
            </a>
            <a
              href="/fests"
              class="nav-link py-2 hover:text-cyan transition-colors"
            >
              Fests
            </a>
            <a
              href="/about"
              class="nav-link py-2 hover:text-cyan transition-colors"
            >
              About
            </a>
            <!-- CodeSprint CTA Desktop -->
            <a href="/codesprint" class="ml-4 px-5 py-2 rounded-full font-bold text-white bg-gradient-to-r from-cyan-500 via-blue-600 to-purple-600 shadow-lg hover:from-cyan-600 hover:to-purple-700 transition-all duration-200 border-2 border-cyan-400 flex items-center gap-2 animate-pulse">
              <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M12 20a8 8 0 100-16 8 8 0 000 16z"/></svg>
              CodeSprint 2025
            </a>
            <div class="flex items-center space-x-4 ml-6">
              <a
                href="/login"
                class="bg-transparent border-2 border-cyan hover:bg-cyan/10 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors"
              >
                Login
              </a>
              <a
                href="/signup"
                class="text-white bg-red hover:bg-red/90 px-4 py-2 rounded-md text-sm font-medium transition-colors border-2 border-red"
              >
                Sign Up
              </a>
            </div>
          </nav>
        </div>
        <!-- Mobile menu: hidden by default and toggled via button -->
        <nav id="mobile-menu" class="mt-4 flex-col gap-y-4 hidden md:hidden">
          <a href="/home" class="block nav-link py-2 hover:text-cyan transition-colors">Home</a>
          <a href="/fests" class="block nav-link py-2 hover:text-cyan transition-colors">Fests</a>
          <a href="/about" class="block nav-link py-2 hover:text-cyan transition-colors">About</a>
          <!-- CodeSprint CTA Mobile -->
          <a href="/codesprint" class="my-2 px-5 py-2 rounded-full font-bold text-white bg-gradient-to-r from-cyan-500 via-blue-600 to-purple-600 shadow-lg hover:from-cyan-600 hover:to-purple-700 transition-all duration-200 border-2 border-cyan-400 flex items-center gap-2 animate-pulse">
            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M12 20a8 8 0 100-16 8 8 0 000 16z"/></svg>
            CodeSprint 2025
          </a>
          <div class="flex flex-col items-start space-y-2 ml-0">
            <a href="/login" class="nav-link py-2 hover:text-cyan transition-colors">
              login            
            </a>
            <a href="/signup" class="bg-transparent border-2 border-cyan hover:bg-cyan/10 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors">
              signup
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