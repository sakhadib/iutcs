@extends('layouts.main')

@section('main')
<main class="py-12">
    <div
      class="container mx-auto shadow-lg border border-gray-100 rounded-xl"
    >
      <div class="bg-white rounded-xl overflow-hidden">
        <div class="h-64 bg-red relative">
          <div
            class="absolute inset-0 flex items-center justify-center text-white text-2xl font-bold"
          >
            Image
          </div>
        </div>

        <div class="px-6 pt-6 md:px-8 md:pt-6">
          <div class="flex flex-wrap gap-4 mb-4">
            <span
              class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium flex items-center"
            >
              May 10-20, 2023
            </span>

            <span
              class="bg-navy/10 text-navy px-3 py-1 rounded-full text-sm font-medium flex items-center"
              >IUT Campus
            </span>

            <span
              class="bg-cyan/10 text-cyan px-3 py-1 rounded-full text-sm font-medium flex items-center"
              >15+ Events
            </span>
          </div>

          <h1 class="text-3xl font-bold mb-4">ICT Fest 2025</h1>
          <p class="text-gray-600 mb-6">
            The ICT Fest is the flagship event of the IUT Computer Society,
            bringing together tech enthusiasts from all over the country. The
            festival features a wide range of events including programming
            contests, hackathons, gaming competitions, project showcases, and
            workshops on cutting-edge technologies. The 10th edition promises
            to be bigger and better than ever, with exciting prizes and
            networking opportunities with industry professionals.
          </p>
        </div>
      </div>

      <div
        id="events"
        class="p-6 md:p-8"
      >
        <h2 class="text-2xl font-bold mb-6">Events</h2>
        <div
          class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 justify-center"
        >
          <!-- EVENT CARD START -->
          <div
            class="bg-white rounded-lg overflow-hidden shadow-md border border-gray-100 hover:shadow-lg transition-shadow"
          >
            <div class="h-48 bg-red relative">
              <div
                class="absolute inset-0 flex items-center justify-center text-white text-lg font-medium"
              >
                Image
              </div>
            </div>
            <div class="p-5">
              <div class="flex justify-between items-center mb-3">
                <span
                  class="bg-cyan/10 text-cyan px-3 py-1 rounded-full text-sm font-medium"
                >
                  Competition
                </span>
                <span class="text-sm text-gray-500 flex items-center">
                  May 15, 2025
                </span>
              </div>
              <h3 class="text-xl font-bold mb-2">Coderush 2.0</h3>
              <a
                href="./event-details.html"
                class="text-red font-medium hover:underline flex items-center"
              >
                View Details
              </a>
            </div>
          </div>
          <!-- EVENT CARD END -->
        </div>
      </div>
    </div>
  </main>


@endsection