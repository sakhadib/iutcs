<footer class="bg-gradient-to-b from-[#0a192f] to-[#020c1b] text-gray-300 py-16 relative overflow-hidden">
  <!-- Animated background elements -->
  <div class="absolute inset-0 opacity-10" style="background-image: url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTYiIGhlaWdodD0iMTYiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PHBhdGggZD0iTTAgOGgxNk0wIDBoMTZNNCAwaDE2TTQgOGgxNk0wIDRoMTZNNCA0aDE2TTQgMTJoMTZNMCAxMmgxNiIgZmlsbD0ibm9uZSIgc3Ryb2tlPSIjZmZmIiBzdHJva2Utb3BhY2l0eT0iMC4xIi8+PC9zdmc+');"></div>
  <div class="absolute inset-0 bg-gradient-to-r from-cyan-500/5 to-purple-500/5 pointer-events-none"></div>

  <div class="container mx-auto px-6 relative z-10">
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-12">
      <!-- Logo Section with Hover Effect -->
      <div class="group relative">
        <div class="absolute -inset-1 bg-gradient-to-r from-cyan-500 to-purple-600 rounded-lg blur opacity-25 group-hover:opacity-40 transition duration-1000"></div>
        <div class="relative bg-[#0a192f]/90 rounded-lg p-6 border border-gray-800/50 backdrop-blur-sm">
          <img src="/rsx/logo.svg" alt="IUTCS Logo" class="w-48 mb-4 transition-transform duration-500 hover:scale-105">
          <p class="text-sm leading-relaxed text-gray-400/80">
            Pioneering technological innovation at Islamic University of Technology.<br>
            <span class="text-cyan-400/90 mt-2 inline-block">#BuildTheFuture</span>
          </p>
        </div>
      </div>

      <!-- Quick Links with Animated Underline -->
      <div class="space-y-6">
        <h3 class="text-xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-purple-400 mb-4">Explore</h3>
        <ul class="space-y-4">
          <li>
            <a href="./home.html" class="flex items-center group text-gray-300 hover:text-white transition-all duration-300">
              <span class="h-[2px] w-4 bg-cyan-400 mr-2 transition-all duration-300 group-hover:w-6"></span>
              Home
            </a>
          </li>
          <li>
            <a href="./fests.html" class="flex items-center group text-gray-300 hover:text-white transition-all duration-300">
              <span class="h-[2px] w-4 bg-purple-400 mr-2 transition-all duration-300 group-hover:w-6"></span>
              Fests
            </a>
          </li>
          <li>
            <a href="./about.html" class="flex items-center group text-gray-300 hover:text-white transition-all duration-300">
              <span class="h-[2px] w-4 bg-cyan-400 mr-2 transition-all duration-300 group-hover:w-6"></span>
              About
            </a>
          </li>
        </ul>
      </div>

      <!-- Contact Section with Icons -->
      <div class="space-y-6">
        <h3 class="text-xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-purple-400 to-cyan-400 mb-4">Connect</h3>
        <address class="not-italic space-y-4">
          <div class="flex items-center">
            <i class="bi bi-geo-alt text-cyan-400 mr-3 text-lg"></i>
            <p class="text-gray-400/90">Islamic University of Technology<br>Board Bazar, Gazipur-1704</p>
          </div>
          <div class="flex items-center">
            <i class="bi bi-envelope text-purple-400 mr-3 text-lg"></i>
            <a href="mailto:iutcs@iut-dhaka.edu" class="text-gray-400/90 hover:text-cyan-300 transition-colors">iutcs@iut-dhaka.edu</a>
          </div>
        </address>
      </div>

      <!-- Social Media Links -->
      <div class="space-y-6">
        <h3 class="text-xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-purple-400 mb-4">Follow</h3>
        <div class="flex space-x-4">
          <a href="#" class="p-2 rounded-lg bg-gray-800/50 hover:bg-cyan-500/20 transition-all duration-300 group">
            <i class="bi bi-github text-2xl text-gray-400 group-hover:text-cyan-400"></i>
          </a>
          <a href="#" class="p-2 rounded-lg bg-gray-800/50 hover:bg-purple-500/20 transition-all duration-300 group">
            <i class="bi bi-linkedin text-2xl text-gray-400 group-hover:text-purple-400"></i>
          </a>
          <a href="#" class="p-2 rounded-lg bg-gray-800/50 hover:bg-cyan-500/20 transition-all duration-300 group">
            <i class="bi bi-discord text-2xl text-gray-400 group-hover:text-cyan-400"></i>
          </a>
        </div>
      </div>
    </div>

    <!-- Copyright Section with Glowing Border -->
    <div class="border-t border-gray-800 mt-12 pt-8 text-center relative">
      <div class="absolute top-0 left-1/2 -translate-x-1/2 -translate-y-1/2 w-32 h-px bg-gradient-to-r from-transparent via-cyan-400 to-transparent"></div>
      <p class="text-sm text-gray-500/80">&copy; {{ date('Y') }} IUTCS. All rights reserved.</p>
      <p class="text-sm mt-2 text-gray-500/80">
        Crafted with <span class="text-red-400">❤️</span> by 
        <a href="https://portfolio.sakhawatadib.com" class="hover:text-cyan-400 transition-colors">Adib Sakhawat</a>
      </p>
    </div>
  </div>
</footer>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>
  @import url("https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap");


:root {
  --color-navy: #0a1929;
  --color-red: #e63946;
  --color-cyan: #00a8e8;
}

*,
*::before,
*::after {
  box-sizing: border-box;
  font-family: "Inter", sans-serif;
}

html {
  height: 100%;
}

body {
  min-height: 100%;
}

body {
  font-family: sans-serif;
}

.nav-link {
  position: relative;
}

.nav-link::after {
  content: "";
  position: absolute;
  width: 0;
  height: 2px;
  bottom: -2px;
  left: 0;
  background-color: var(--color-red);
  transition: width 0.3s ease;
}

.nav-link:hover::after {
  width: 100%;
}

.active-nav-link::after {
  width: 100%;
}

button {
  cursor: pointer;
}

  </style>

<style>
  @import url('https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;600;700&display=swap');

  /* body {
    font-family: 'Space Grotesk', sans-serif;
    background: #0a192f;
  } */

  .gradient-text {
    background: linear-gradient(45deg, #00f7ff, #9d4dff);
    -webkit-background-clip: text;
    background-clip: text;
    color: transparent;
  }

  .hover-glow:hover {
    filter: drop-shadow(0 0 8px rgba(0, 247, 255, 0.3));
  }

  .cyber-border {
    border: 2px solid #00f7ff;
    box-shadow: 0 0 15px rgba(0, 247, 255, 0.2);
  }
</style>

  <style>
    a, button {
      text-decoration: none !important;
    }

    .ft-clr{
      color: #e63946 !important;
    }
  </style>
</body>
</html>