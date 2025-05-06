@extends('layouts.main')

@section('main')
<main>
    <div
    class="bg-white shadow-lg rounded-2xl p-8 max-w-2xl w-full mx-auto mt-8 mb-8"
  >
    <h1 class="text-3xl font-bold mb-6 text-center">Fest Registration</h1>

    <form class="space-y-6">
      

      <!-- Team Members -->
      <div class="space-y-4">
        <h2 class="text-xl font-semibold">Team Members</h2>

        <!-- Member 1 -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
          <div>
            <label
              class="block text-gray-600 mb-1"
              for="member1-name"
              >Member 1 Name</label
            >
            <input
              type="text"
              id="member1-name"
              name="member1-name"
              placeholder="Enter Name"
              class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-gray-400"
            />
          </div>
          <div>
            <label
              class="block text-gray-600 mb-1"
              for="member1-institution"
              >Institution</label
            >
            <input
              type="text"
              id="member1-institution"
              name="member1-institution"
              placeholder="Enter Institution"
              class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-gray-400"
            />
          </div>
        </div>

        <!-- Member 2 -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
          <div>
            <label
              class="block text-gray-600 mb-1"
              for="member2-name"
              >Member 2 Name</label
            >
            <input
              type="text"
              id="member2-name"
              name="member2-name"
              placeholder="Enter Name"
              class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-gray-400"
            />
          </div>
          <div>
            <label
              class="block text-gray-600 mb-1"
              for="member2-institution"
              >Institution</label
            >
            <input
              type="text"
              id="member2-institution"
              name="member2-institution"
              placeholder="Enter Institution"
              class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-gray-400"
            />
          </div>
        </div>

        <!-- Member 3 -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
          <div>
            <label
              class="block text-gray-600 mb-1"
              for="member3-name"
              >Member 3 Name</label
            >
            <input
              type="text"
              id="member3-name"
              name="member3-name"
              placeholder="Enter Name"
              class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-gray-400"
            />
          </div>
          <div>
            <label
              class="block text-gray-600 mb-1"
              for="member3-institution"
              >Institution</label
            >
            <input
              type="text"
              id="member3-institution"
              name="member3-institution"
              placeholder="Enter Institution"
              class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-gray-400"
            />
          </div>
        </div>
      </div>

      <!-- Submit Button -->
      <div class="text-center pt-6">
        <button
          type="submit"
          class="bg-gray-800 text-white font-semibold py-3 px-8 rounded-lg hover:bg-gray-700 transition"
        >
          Register
        </button>
      </div>
    </form>
  </div>
</main>

@endsection