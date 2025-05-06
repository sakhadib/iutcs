@extends('layouts.main')

@section('main')
<main class="py-12">
    <div class="container mx-auto px-4">
      <div
        class="bg-white rounded-xl overflow-hidden shadow-lg border border-gray-100 mb-12"
      >
        <div class="h-64 md:h-80 bg-red relative">
          <div
            class="absolute inset-0 flex items-center justify-center text-white text-2xl font-bold"
          >
            Image
          </div>
        </div>
        <div class="p-6 md:p-8">
          <div class="flex flex-wrap gap-4 mb-4">
            <span
              class="bg-cyan/10 text-cyan px-3 py-1 rounded-full text-sm font-medium flex items-center"
            >
              Hackathon
            </span>
            <span
              class="bg-navy/10 text-navy px-3 py-1 rounded-full text-sm font-medium flex items-center"
            >
              May 15, 2025 9:00 AM
            </span>
            <span
              class="bg-navy/10 text-navy px-3 py-1 rounded-full text-sm font-medium flex items-center"
            >
              ACB-2
            </span>
          </div>
          <h1 class="text-3xl font-bold mb-4">CodeRush 2.0</h1>
          <p class="text-gray-600 mb-6">
            CodeRush 2.0 is a 24-hour hackathon where teams of up to 4 members
            will compete to build innovative solutions to real-world problems.
            The event aims to foster creativity, teamwork, and technical
            skills among participants. Teams will be provided with themes at
            the beginning of the hackathon and will have 24 hours to ideate,
            design, and develop a working prototype. Industry experts will
            mentor the teams throughout the event and judge the final
            presentations.
          </p>
          <a
            href="./event-registration.html"
            class="bg-red hover:bg-red/90 text-white px-6 py-3 rounded-md font-medium transition-colors inline-flex items-center"
          >
            Register Now
          </a>
        </div>
      </div>

      <div class="grid md:grid-cols-3 gap-8">
        <div class="md:col-span-2">
          <!-- Rules Section -->
          <div class="bg-white rounded-lg shadow-md p-6 mb-8">
            <h2 class="text-2xl font-bold mb-4">Rules & Guidelines</h2>
            <ul class="list-disc pl-5 space-y-2 text-gray-700">
              <li>
                Teams must consist of 2-4 members (can be from different
                institutions).
              </li>
              <li>
                All team members must be present during the entire duration of
                the hackathon.
              </li>
              <li>
                Teams can use any programming language or technology stack.
              </li>
              <li>
                The solution must be developed entirely during the hackathon.
              </li>
              <li>
                Teams must present a working prototype at the end of the
                hackathon.
              </li>
              <li>
                Judging will be based on innovation, technical complexity,
                design, and presentation.
              </li>
            </ul>
          </div>

          <!-- Prizes Section -->
          <div class="bg-white rounded-lg shadow-md p-6 mb-8">
            <h2 class="text-2xl font-bold mb-4">Prizes</h2>
            <ul class="list-disc pl-5 space-y-2 text-gray-700">
              <li>1st Place: 40,000 BDT</li>
              <li>2nd Place: 25,000 BDT</li>
              <li>3rd Place: 15,000 BDT</li>
            </ul>
          </div>
        </div>

        <div>
          <div class="bg-white rounded-lg shadow-md p-6 sticky top-24">
            <h2 class="text-xl font-bold mb-4">Registration Information</h2>

            <div class="space-y-4">
              <div>
                <h3 class="font-medium text-gray-700">Registration Fee</h3>
                <p class="text-lg font-semibold">1200 BDT</p>
              </div>

              <div>
                <h3 class="font-medium text-gray-700">Status</h3>
                <p class="text-lg font-semibold text-green-600">Open</p>
              </div>

              <a
                href="/fest/1/event/1/register"
                class="w-full bg-red hover:bg-red/90 text-white py-3 rounded-md font-medium transition-colors inline-flex items-center justify-center mt-4"
                >Register Now</a
              >
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

@endsection