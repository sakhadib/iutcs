@extends('layouts.main')

@section('main')
<main class="min-h-screen">
    <div>
      <section
        class="bg-navy text-white pt-40 pb-56 relative overflow-hidden"
      >
        <div class="hero-pattern absolute inset-0 opacity-10"></div>
        <div class="container mx-auto px-4 relative z-10">
          <div class="max-w-3xl">
            <h1 class="text-4xl md:text-6xl font-bold mb-6">
              Welcome to <span class="text-red">IUT</span> Computer Society
            </h1>
            <p class="text-xl md:text-2xl mb-8 text-gray-200">
              Fostering innovation, collaboration, and technological
              excellence in the IUT community
            </p>
            <div class="flex flex-wrap gap-4">
              <a
                href="/"
                class="bg-red hover:bg-red/90 text-white px-6 py-3 rounded-md font-medium transition-colors"
              >
                Explore Fests
              </a>
              <a
                href="/"
                class="bg-transparent border-2 border-cyan hover:bg-cyan/10 text-white px-6 py-3 rounded-md font-medium transition-colors"
              >
                About Us
              </a>
            </div>
          </div>
        </div>
      </section>

      <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
          <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold mb-4">Featured Fest</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">
              Discover our flagship technology festival that brings together
              the brightest minds in computing
            </p>
          </div>

          <div
            class="bg-gray-50 rounded-xl overflow-hidden shadow-lg max-w-4xl mx-auto"
          >
            <div class="h-64 bg-red relative">
              <div
                class="absolute inset-0 flex items-center justify-center text-white text-xl font-bold"
              >
                Image
              </div>
            </div>
            <div class="p-6 md:p-8">
              <div class="flex flex-wrap gap-4 mb-4">
                <span
                  class="bg-navy/10 text-navy px-3 py-1 rounded-full text-sm font-medium flex items-center"
                >
                  Ongoing
                </span>
                <span
                  class="bg-navy/10 text-navy px-3 py-1 rounded-full text-sm font-medium flex items-center"
                >
                  IUT Campus
                </span>
              </div>
              <h3 class="text-2xl font-bold mb-3">ICT Fest 2025</h3>
              <p class="text-gray-600 mb-6">
                The Xth ICT Fest brings together students from universities
                across the country to compete in various technology-focused
                events, from programming contests to hackathons and gaming
                competitions.
              </p>
              <div class="flex justify-between items-center">
                <div class="flex items-center">
                  <span class="text-gray-700">15+ Events</span>
                </div>
                <a
                  href="./fest/fest.html"
                  class="flex items-center text-red font-medium hover:underline"
                >
                  View Details
                </a>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </main>

  <style>
    .hero-pattern {
        background-image: radial-gradient(#00a8e833 1px, transparent 1px),
                          radial-gradient(#00a8e833 1px, transparent 1px);
        background-size: 20px 20px;
        background-position: 0 0, 10px 10px;
    }
  </style>

@endsection