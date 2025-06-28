@extends('layouts.main')

@section('main')
<div class="min-h-screen bg-white">
    <!-- Hero Section -->
    <section class="relative bg-gradient-to-br from-gray-50 via-blue-50/30 to-slate-50 overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0">
            <div class="absolute top-0 -left-4 w-72 h-72 bg-blue-100/40 rounded-full mix-blend-multiply filter blur-xl opacity-70"></div>
            <div class="absolute top-0 -right-4 w-72 h-72 bg-slate-100/40 rounded-full mix-blend-multiply filter blur-xl opacity-70"></div>
            <div class="absolute -bottom-8 left-20 w-72 h-72 bg-emerald-100/40 rounded-full mix-blend-multiply filter blur-xl opacity-70"></div>
        </div>
        
        <!-- Grid Pattern -->
        <div class="absolute inset-0 bg-[linear-gradient(to_right,#8882_1px,transparent_1px),linear-gradient(to_bottom,#8882_1px,transparent_1px)] bg-[size:14px_24px]"></div>
        
        <div class="relative container mx-auto px-4 py-24">
            <div class="max-w-4xl mx-auto text-center">
                <div class="inline-flex items-center px-4 py-2 bg-white/80 backdrop-blur-sm border border-gray-200/50 rounded-full text-sm font-medium text-gray-700 mb-8 shadow-sm">
                    <span class="w-2 h-2 bg-emerald-500 rounded-full mr-2"></span>
                    IUT Computer Society
                </div>
                
                <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold text-gray-900 mb-6 tracking-tight">
                    Festivals &
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-slate-700">Events</span>
                </h1>
                
                <p class="text-xl text-gray-600 max-w-2xl mx-auto leading-relaxed">
                    Discover tech competitions and events
                </p>
                
                @if(session('role') === 'admin')
                <div class="mt-12">
                    <a href="/admin/fests/create" 
                       class="inline-flex items-center px-6 py-3 bg-gray-900 hover:bg-gray-800 text-white rounded-lg font-medium transition-all duration-200 shadow-lg hover:shadow-xl">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Create New Fest
                    </a>
                </div>
                @endif
            </div>
        </div>
    </section>

    <div class="container mx-auto px-4 py-20">
        
        <!-- Ongoing Fests Section -->
        @if($ongoing_fests->count() > 0)
        <section class="mb-24">
            <div class="flex items-center justify-between mb-12">
                <div class="flex items-center space-x-3">
                    <div class="w-3 h-3 bg-emerald-500 rounded-full"></div>
                    <h2 class="text-3xl font-bold text-gray-900">Live Now</h2>
                    <span class="bg-emerald-100 text-emerald-700 px-3 py-1 rounded-full text-sm font-medium">
                        {{ $ongoing_fests->count() }}
                    </span>
                </div>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                @foreach($ongoing_fests as $fest)
                <div class="group relative bg-white border border-gray-200 rounded-2xl overflow-hidden hover:border-gray-300 hover:shadow-xl transition-all duration-300">
                    <!-- Live Badge -->
                    <div class="absolute top-4 left-4 z-10">
                        <div class="flex items-center px-3 py-1 bg-emerald-500 text-white rounded-full text-sm font-medium">
                            <div class="w-2 h-2 bg-white rounded-full mr-2 animate-pulse"></div>
                            LIVE
                        </div>
                    </div>
                    
                    <!-- Image -->
                    <div class="relative h-64 bg-gray-100">
                        @if($fest->image)
                            <img src="{{ $fest->image }}" alt="{{ $fest->title }}" 
                                 class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                                <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        @endif
                    </div>
                    
                    <!-- Content -->
                    <div class="p-8">
                        <!-- Meta Tags -->
                        <div class="flex flex-wrap gap-2 mb-4">
                            @if($fest->start_date)
                            <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-lg text-sm font-medium">
                                {{ \Carbon\Carbon::parse($fest->start_date)->format('M Y') }}
                            </span>
                            @endif
                            @if($fest->location)
                            <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-lg text-sm font-medium">
                                {{ $fest->location }}
                            </span>
                            @endif
                        </div>
                        
                        <!-- Title -->
                        <h3 class="text-2xl font-bold text-gray-900 mb-3">
                            {{ $fest->title }}
                        </h3>
                        
                        <!-- Description -->
                        <p class="text-gray-600 mb-6 line-clamp-2">
                            {{ Str::limit($fest->description, 120) }}
                        </p>
                        
                        <!-- Footer -->
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-500">{{ $fest->events_count }} events</span>
                            <a href="/fest/{{ $fest->id }}" 
                               class="inline-flex items-center px-6 py-3 bg-gray-900 hover:bg-gray-800 text-white rounded-lg font-medium transition-colors duration-200">
                                View Details
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </section>
        @endif

        <!-- Upcoming Fests Section -->
        @if($upcoming_fests->count() > 0)
        <section class="mb-24">
            <div class="flex items-center space-x-3 mb-12">
                <div class="w-3 h-3 bg-blue-500 rounded-full"></div>
                <h2 class="text-3xl font-bold text-gray-900">Coming Soon</h2>
                <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm font-medium">
                    {{ $upcoming_fests->count() }}
                </span>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($upcoming_fests as $fest)
                @php
                    $firstEvent = $fest->events->first();
                    $daysUntil = $firstEvent ? \Carbon\Carbon::parse($firstEvent->start_date)->diffInDays(now()) : 0;
                @endphp
                <div class="group bg-white border border-gray-200 rounded-xl overflow-hidden hover:border-gray-300 hover:shadow-lg transition-all duration-300">
                    <!-- Countdown Badge -->
                    <div class="absolute top-4 right-4 z-10">
                        <span class="bg-blue-500 text-white px-3 py-1 rounded-lg text-sm font-medium">
                            {{ $daysUntil }} days
                        </span>
                    </div>
                    
                    <!-- Image -->
                    <div class="relative h-48 bg-gray-100">
                        @if($fest->image)
                            <img src="{{ $fest->image }}" alt="{{ $fest->title }}" 
                                 class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        @endif
                    </div>
                    
                    <!-- Content -->
                    <div class="p-6">
                        <div class="flex flex-wrap gap-2 mb-3">
                            @if($firstEvent)
                            <span class="bg-gray-100 text-gray-700 px-2 py-1 rounded-lg text-xs font-medium">
                                {{ \Carbon\Carbon::parse($firstEvent->start_date)->format('M j, Y') }}
                            </span>
                            @endif
                            @if($fest->location)
                            <span class="bg-gray-100 text-gray-700 px-2 py-1 rounded-lg text-xs font-medium">
                                {{ $fest->location }}
                            </span>
                            @endif
                        </div>
                        
                        <h3 class="text-xl font-bold text-gray-900 mb-2">
                            {{ $fest->title }}
                        </h3>
                        
                        <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                            {{ Str::limit($fest->description, 100) }}
                        </p>
                        
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-500">{{ $fest->events_count }} events</span>
                            <a href="/fest/{{ $fest->id }}" 
                               class="text-blue-600 hover:text-blue-800 font-medium text-sm transition-colors duration-200">
                                Learn More →
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </section>
        @endif

        <!-- Past Fests Section -->
        @if($past_fests->count() > 0)
        <section>
            <div class="flex items-center space-x-3 mb-12">
                <div class="w-3 h-3 bg-gray-400 rounded-full"></div>
                <h2 class="text-3xl font-bold text-gray-900">Past Events</h2>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($past_fests as $fest)
                <div class="group bg-white border border-gray-200 rounded-xl overflow-hidden hover:border-gray-300 transition-all duration-300">
                    <div class="relative h-40 bg-gray-100">
                        @if($fest->image)
                            <img src="{{ $fest->image }}" alt="{{ $fest->title }}" 
                                 class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-300">
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                                <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        @endif
                        
                        <!-- Completed Badge -->
                        <div class="absolute top-3 left-3">
                            <span class="bg-gray-800 text-white px-2 py-1 rounded-lg text-xs font-medium">
                                Completed
                            </span>
                        </div>
                    </div>
                    
                    <div class="p-5">
                        <div class="flex flex-wrap gap-1 mb-2">
                            @if($fest->start_date)
                            <span class="bg-gray-100 text-gray-600 px-2 py-1 rounded-lg text-xs">
                                {{ \Carbon\Carbon::parse($fest->start_date)->format('M Y') }}
                            </span>
                            @endif
                        </div>
                        
                        <h3 class="text-lg font-bold text-gray-900 mb-2">{{ $fest->title }}</h3>
                        <p class="text-gray-600 text-sm mb-3 line-clamp-2">
                            {{ Str::limit($fest->description, 80) }}
                        </p>
                        
                        <div class="flex justify-between items-center">
                            <span class="text-xs text-gray-500">{{ $fest->events_count }} events</span>
                            <a href="/fest/{{ $fest->id }}" 
                               class="text-gray-600 hover:text-gray-900 text-sm font-medium transition-colors duration-200">
                                View Details
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </section>
        @endif

        <!-- Empty State -->
        @if($ongoing_fests->count() == 0 && $upcoming_fests->count() == 0 && $past_fests->count() == 0)
        <section class="text-center py-24">
            <div class="max-w-md mx-auto">
                <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-8">
                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-gray-900 mb-4">No Festivals Yet</h2>
                <p class="text-gray-600 mb-8">Check back soon for exciting tech events!</p>
                
                @if(session('role') === 'admin')
                <a href="/admin/fests/create" 
                   class="inline-flex items-center px-6 py-3 bg-gray-900 hover:bg-gray-800 text-white rounded-lg font-medium transition-colors duration-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Create First Festival
                </a>
                @endif
            </div>
        </section>
        @endif
    </div>
</div>

<style>
/* Line clamping */
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* Smooth transitions */
* {
    transition-property: color, background-color, border-color, text-decoration-color, fill, stroke, opacity, box-shadow, transform, filter, backdrop-filter;
    transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
    transition-duration: 200ms;
}

/* Custom hover effects */
.group:hover img {
    transform: scale(1.02);
}

/* Focus states */
a:focus-visible {
    outline: 2px solid #3b82f6;
    outline-offset: 2px;
}

/* Subtle animations */
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

.animate-fade-in {
    animation: fadeIn 0.4s ease-out;
}

/* Card shadows */
.hover\\:shadow-xl:hover {
    box-shadow: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
}

.hover\\:shadow-lg:hover {
    box-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add fade in animation to cards
    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-fade-in');
                }
            });
        },
        { threshold: 0.1 }
    );

    document.querySelectorAll('.group').forEach(card => {
        observer.observe(card);
    });
});
</script>
@endsection