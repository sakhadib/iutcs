@extends('layouts.main')

@section('main')
<main>
    <div class="py-12">
      <div
        class="max-w-md mx-auto bg-white rounded-xl shadow-lg overflow-hidden"
      >
        <div class="bg-navy text-white p-6 text-center">
          <h1 class="text-2xl font-bold">Create an Account</h1>
          <p class="text-gray-200 mt-2">Join the IUTCS community</p>
        </div>

        <div
          id="error-message"
          class="bg-red/10 text-red p-3 mx-6 mt-6 rounded-md text-sm"
        ></div>

        <form
          id="signup-form"
          class="p-6 space-y-4"
          action="/signup"
          method="POST"
        >
          @csrf  <!-- CSRF token for security -->
          <div>
            <label
              htmlFor="fullName"
              class="block text-sm font-medium text-gray-700 mb-1"
            >
              Full Name
            </label>
            <input
              id="fullName"
              name="name"
              type="text"
              required
              class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-cyan focus:border-transparent"
              placeholder="John Doe"
            />
          </div>

          <div>
            <label
              htmlFor="email"
              class="block text-sm font-medium text-gray-700 mb-1"
            >
              Email
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
              htmlFor="StudentID"
              class="block text-sm font-medium text-gray-700 mb-1"
            >
              Student ID
            </label>
            <input
              id="studentID"
              name="studentID"
              type="text"
              autocomplete="studentID"
              required
              class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-cyan focus:border-transparent"
              placeholder="your student id"
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
              autocomplete="new-password"
              required
              class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-cyan focus:border-transparent"
              placeholder="••••••••"
            />
          </div>

          <div>
            <label
              htmlFor="confirmPassword"
              class="block text-sm font-medium text-gray-700 mb-1"
            >
              Confirm Password
            </label>
            <input
              id="confirmPassword"
              name="confirmPassword"
              type="password"
              autocomplete="new-password"
              required
              class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-cyan focus:border-transparent"
              placeholder="••••••••"
            />
          </div>

          <div class="pt-4">
            <button
              type="submit"
              class="w-full flex justify-center items-center py-2 px-4 border border-transparent rounded-md shadow-sm text-white bg-red hover:bg-red/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red cursor-pointer"
            >
              Create Account
            </button>
          </div>
        </form>

        <div class="px-6 pb-6 text-center">
          <p class="text-sm text-gray-600">
            Already have an account?
            <a
              href="login"
              class="font-medium text-cyan hover:text-cyan/80"
            >
              Login
            </a>
          </p>
        </div>
      </div>
    </div>
  </main>


  <script>
    const signupForm = document.getElementById("signup-form");
const nameField = document.getElementById("fullName");
const emailField = document.getElementById("email");
const passwordField = document.getElementById("password");
const confirmPasswordField = document.getElementById("confirmPassword");
const errorBlock = document.getElementById("error-message");

// assign error message and set display to block to display validation errors
errorBlock.textContent = "";
errorBlock.style.display = "none";

  </script>

@endsection