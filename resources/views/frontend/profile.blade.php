@extends('layouts.main')
@section('main')

<div class="container mx-auto px-4 py-8 max-w-4xl">
  <!-- Profile Header -->
  <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <!-- Cover Photo -->
    <div class="h-32 bg-gradient-to-r from-blue-100 to-indigo-100 relative">
      <div class="absolute -bottom-16 left-6">
        <img src="https://avatar.iran.liara.run/public/{{ $user->userInfo->gender }}?username={{ explode('@', $user->email)[0] }}"
           alt="Avatar"
           class="w-32 h-32 rounded-full border-4 border-white shadow-lg">
      </div>
    </div>

    <!-- Profile Info -->
    <div class="pt-20 px-6 pb-6">
      <div class="flex items-center gap-3 mb-4">
        <h1 class="text-2xl font-bold text-gray-800">{{ $user->name }}</h1>
        <span class="text-sm px-3 py-1 rounded-full bg-blue-100 text-blue-800">{{ $user->batch ?? 'Batch not set' }}</span>
      </div>
      
      <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm mb-6">
        <div class="flex items-center gap-2">
          <i class="bi bi-person-badge text-gray-500"></i>
          <span>{{ $user->student_id }}</span>
        </div>
        <div class="flex items-center gap-2">
          <i class="bi bi-building text-gray-500"></i>
          <span>{{ $user->university ?? 'University not set' }}</span>
        </div>
        <div class="flex items-center gap-2">
          <i class="bi bi-gender-ambiguous text-gray-500"></i>
          <span>{{ ucfirst($user->userInfo->gender ?? 'Not set') }}</span>
        </div>
        <div class="flex items-center gap-2">
          <i class="bi bi-clock text-gray-500"></i>
            <span>{{ $user->last_login ? \Carbon\Carbon::parse($user->last_login)->diffForHumans() : 'Never logged in' }}</span>
        </div>
      </div>
    </div>
  </div>

  <!-- Main Content -->
  <div class="grid gap-6 md:grid-cols-3 mt-8">
    <!-- Left Column -->
    <div class="md:col-span-2 space-y-6">
      <!-- Bio Section -->
      <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
        <h3 class="text-lg font-semibold mb-4 flex items-center gap-2">
          <i class="bi bi-pencil-square text-blue-600"></i>
          About Me
        </h3>
        <p class="text-gray-600 leading-relaxed">
          {{ $user->userInfo->bio ?? 'No bio provided.' }}
        </p>
      </div>

      <!-- Contact Info -->
      <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
        <h3 class="text-lg font-semibold mb-4 flex items-center gap-2">
          <i class="bi bi-envelope text-blue-600"></i>
          Contact Information
        </h3>
        <div class="space-y-3">
          <div class="flex items-center gap-3">
            <i class="bi bi-envelope text-gray-500 w-5"></i>
            <a href="mailto:{{ $user->email }}" class="text-blue-600 hover:underline">{{ $user->email }}</a>
          </div>
          <div class="flex items-center gap-3">
            <i class="bi bi-telephone text-gray-500 w-5"></i>
            <span class="text-gray-600">Private</span>
          </div>
          <div class="flex items-center gap-3">
            <i class="bi bi-geo-alt text-gray-500 w-5"></i>
            <span class="text-gray-600">{{ $user->userInfo->address ?? 'Address not set' }}</span>
          </div>
        </div>
      </div>
    </div>

    <!-- Right Column -->
    <div class="space-y-6">
      <!-- Social Links -->
      <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
        <h3 class="text-lg font-semibold mb-4 flex items-center gap-2">
          <i class="bi bi-share text-blue-600"></i>
          Social Profiles
        </h3>
        <div class="space-y-3">
          @if($user->userInfo->website)
          <a href="{{ $user->userInfo->website }}" target="_blank" class="flex items-center gap-3 text-gray-600 hover:text-blue-600 transition-colors">
            <i class="bi bi-globe w-5"></i>
            <span class="truncate">Website</span>
          </a>
          @endif
          
          @if($user->userInfo->linkedin)
          <a href="{{ $user->userInfo->linkedin }}" target="_blank" class="flex items-center gap-3 text-gray-600 hover:text-blue-600 transition-colors">
            <i class="bi bi-linkedin w-5"></i>
            <span class="truncate">LinkedIn</span>
          </a>
          @endif
          
          @if($user->userInfo->github)
          <a href="{{ $user->userInfo->github }}" target="_blank" class="flex items-center gap-3 text-gray-600 hover:text-blue-600 transition-colors">
            <i class="bi bi-github w-5"></i>
            <span class="truncate">GitHub</span>
          </a>
          @endif

          @if(!$user->userInfo->website && !$user->userInfo->linkedin && !$user->userInfo->github)
          <p class="text-gray-500 text-sm">No social profiles added</p>
          @endif
        </div>
      </div>

      <!-- Quick Stats -->
      <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
        <h3 class="text-lg font-semibold mb-4 flex items-center gap-2">
          <i class="bi bi-bar-chart text-blue-600"></i>
          Stats
        </h3>
        <div class="space-y-2">
          <div class="flex justify-between items-center">
            <span class="text-gray-600">No. of Teams</span>
            <span class="text-blue-600 font-medium">{{$team_count}}</span>
          </div>
          
        </div>
      </div>
    </div>
  </div>
</div>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" />
@endsection