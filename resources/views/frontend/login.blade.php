@extends('layouts.main')

@section('main')
<main>
    <div
      class="min-h-[calc(100vh-200px)] flex items-center justify-center py-12"
    >
      <div
        class="max-w-md w-full space-y-8 p-8 bg-white rounded-xl shadow-lg"
      >
        <div class="text-center">
          <h1 class="text-3xl font-bold">Welcome Back</h1>
          <p class="mt-2 text-gray-600">Sign in to your IUTCS account</p>
        </div>
        @if ($errors->any())
          <div
            id="error-message"
            class="bg-red/10 text-red p-3 rounded-md text-sm mb-4"
            role="alert"
          >
            @foreach ($errors->all() as $error)
              <div>{{ $error }}</div>
            @endforeach
          </div>
        @endif

        <form
            id="login-form"
            class="mt-8 space-y-6"
            action="/login"
            method="POST"
        >
            @csrf  <!-- CSRF token for security -->
          <div>
            <label
              htmlFor="email"
              class="block text-sm font-medium text-gray-700 mb-1"
            >
              Email Address
            </label>
            <input
              id="email"
              name="email"
              type="email"
              autocomplete="email"
              required
              class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-cyan focus:border-transparent"
              placeholder="your.email@example.com"
            />
          </div>

          <div>
            <label
              htmlFor="password"
              class="block text-sm font-medium text-gray-700 mb-1"
            >
              Password
            </label>
            <input
              id="password"
              name="password"
              type="password"
              autocomplete="current-password"
              required
              class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-cyan focus:border-transparent"
              placeholder="••••••••"
            />
          </div>

          <div>
            <button
              type="submit"
              class="w-full flex justify-center items-center py-2 px-4 border border-transparent rounded-md shadow-sm text-white bg-red hover:bg-red/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red cursor-pointer"
            >
              Login
            </button>
          </div>
        </form>

        <div class="text-center mt-4">
          <p class="text-sm text-gray-600">
            Don't have an account?
            <a
              href="/signup"
              class="font-medium text-cyan hover:text-cyan/80"
            >
              Sign up
            </a>
          </p>
        </div>
      </div>
    </div>
  </main>




@endsection