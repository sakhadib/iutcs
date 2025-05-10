@extends('layouts.main')

@section('main')
<main>
    <div class="py-12">
      <div class="container mx-auto px-4">
        <div class="text-left mb-12">
          
        </div>

        <div class="flex flex-col gap-y-2">
          <!-- ONGOING FESTS -->
            <section class="mt-2 flex items-center justify-between">
            <h2
              class="text-2xl font-bold mb-6 flex items-center text-left"
            >
              <span class="w-3 h-3 bg-green-500 rounded-full mr-2"></span>
              Current Fest
            </h2>
            @if(session('role') === 'admin')
              <a 
              href="/admin/fests/create" 
              class="bg-gray-800 hover:bg-gray-900 text-white px-4 py-2 rounded-md font-medium transition-colors"
              >
              Create New Fest
              </a>
            @endif
            </section>

            <div class="grid grid-cols-1 gap-6 mt-6">
              <!-- FEST CARD -->
              <div
              class="bg-white rounded-xl overflow-hidden  border border-gray-100 hover:shadow-xl transition-shadow w-full"
              >
              <div class="md:flex">
                <div class="md:w-1/3 h-48 md:h-auto bg-red relative">
                <div
                  class="absolute inset-0 flex items-center justify-center text-white text-xl font-bold"
                >
                  <img src="{{$ongoing_fest->image}}" alt="Fest Image" class="w-full h-full object-cover">
                </div>
                </div>
                <div class="p-6 md:w-2/3">
                <div class="flex flex-wrap gap-3 mb-3">
                  <span
                  class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium flex items-center"
                  >
                    {{ \Carbon\Carbon::parse($ongoing_fest->start_date)->format('F, Y') }}
                  </span>
                  <span
                  class="bg-navy/10 text-navy px-3 py-1 rounded-full text-sm font-medium flex items-center"
                  >
                  {{$ongoing_fest->location}}
                  </span>
                </div>
                <h3 class="text-2xl font-bold mb-3">{{$ongoing_fest->title}}</h3>
                <p class="text-gray-600 mb-6">
                  {{$ongoing_fest->description}}
                </p>
                <div class="flex justify-between items-center">
                  <span class="text-gray-700">{{$ongoing_fest->events_count}} Events</span>
                  <a
                  href="/fest/{{$ongoing_fest->id}}"
                  class="bg-red hover:bg-red/90 text-white px-4 py-2 rounded-md font-medium transition-colors inline-flex items-center"
                  >
                  View Details
                  </a>
                </div>
                </div>
              </div>
              </div>
            </div>
            </section>

          {{-- <section class="mt-20">
            <h2
              class="text-2xl font-bold mb-6 flex items-center justify-center"
            >
              <span class="w-3 h-3 bg-gray-400 rounded-full mr-2"></span>
              Previous Fests
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
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
                  <div class="flex flex-wrap gap-2 mb-3">
                    <span
                      class="bg-gray-100 text-gray-800 px-3 py-1 rounded-full text-sm font-medium flex items-center"
                    >
                      May, 2024
                    </span>
                  </div>
                  <h3 class="text-xl font-bold mb-2">ICT Fest 2024</h3>
                  <p class="text-gray-600 mb-4">
                    The Xth ICT Fest brings together students from
                    universities across the country to compete in various
                    technology focused events.
                  </p>
                  <a
                    href=""
                    class="text-red font-medium hover:underline flex items-center"
                  >
                    View Details
                  </a>
                </div>
              </div>

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
                  <div class="flex flex-wrap gap-2 mb-3">
                    <span
                      class="bg-gray-100 text-gray-800 px-3 py-1 rounded-full text-sm font-medium flex items-center"
                    >
                      May, 2024
                    </span>
                  </div>
                  <h3 class="text-xl font-bold mb-2">ICT Fest 2024</h3>
                  <p class="text-gray-600 mb-4">
                    The Xth ICT Fest brings together students from
                    universities across the country to compete in various
                    technology focused events.
                  </p>
                  <a
                    href=""
                    class="text-red font-medium hover:underline flex items-center"
                  >
                    View Details
                  </a>
                </div>
              </div>

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
                  <div class="flex flex-wrap gap-2 mb-3">
                    <span
                      class="bg-gray-100 text-gray-800 px-3 py-1 rounded-full text-sm font-medium flex items-center"
                    >
                      May, 2024
                    </span>
                  </div>
                  <h3 class="text-xl font-bold mb-2">ICT Fest 2024</h3>
                  <p class="text-gray-600 mb-4">
                    The Xth ICT Fest brings together students from
                    universities across the country to compete in various
                    technology focused events.
                  </p>
                  <a
                    href="../fest/fest.html"
                    class="text-red font-medium hover:underline flex items-center"
                  >
                    View Details
                  </a>
                </div>
              </div>
            </div>
          </section> --}}
        </div>
      </div>
    </div>
  </main>


@endsection