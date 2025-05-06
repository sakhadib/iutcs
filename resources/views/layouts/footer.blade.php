<footer class="bg-navy text-white py-8">
    <div class="container mx-auto px-4">
      <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div>
          <h3 class="text-xl font-bold mb-4">IUTCS</h3>
          <p class="text-gray-300">
            The Computer Society of Islamic University of Technology,
            dedicated to fostering technological innovation and excellence.
          </p>
        </div>
        <div>
          <h3 class="text-xl font-bold mb-4">Quick Links</h3>
          <ul class="space-y-2">
            <li>
              <a
                href="./home.html"
                class="text-gray-300 hover:text-cyan transition-colors"
              >
                Home
              </a>
            </li>
            <li>
              <a
                href="./fests.html"
                class="text-gray-300 hover:text-cyan transition-colors"
              >
                Fests
              </a>
            </li>
            <li>
              <a
                href="./about.html"
                class="text-gray-300 hover:text-cyan transition-colors"
              >
                About
              </a>
            </li>
          </ul>
        </div>
        <div>
          <h3 class="text-xl font-bold mb-4">Contact</h3>
          <address class="not-italic text-gray-300">
            <p>Islamic University of Technology</p>
            <p>Board Bazar, Gazipur-1704</p>
            <p>Bangladesh</p>
            <p class="mt-2">Email: iutcs@iut-dhaka.edu</p>
          </address>
        </div>
      </div>
      <div
        class="border-t border-gray-700 mt-8 pt-6 text-center text-gray-300"
      >
        <p>&copy;IUTCS. All rights reserved.</p>
      </div>
    </div>
  </footer>



  <style>
    @import url("https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap");

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
</body>
</html>