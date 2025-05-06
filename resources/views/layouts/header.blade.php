<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0"
    />
    <title>IUTCS | IUT Computer Society</title>

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

    <header class="bg-navy text-white sticky top-0 z-50 shadow-md px-4 py-6">
      <div class="container mx-auto">
        <div class="flex justify-between items-center">
          <a
            href="/"
            class="flex items-center space-x-2"
          >
            <span class="font-bold text-xl">IUTCS</span>
          </a>
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
      </div>
    </header>