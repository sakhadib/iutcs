@extends('layouts.main')

@section('main')
<div class="min-h-screen bg-gray-50">
    <!-- Hero Section -->
    <section class="relative h-screen bg-gradient-to-br from-slate-900 via-purple-900 to-slate-900 overflow-hidden">
        <div class="absolute inset-0">
            @if($fest->image)
                <img src="{{$fest->image}}" alt="{{$fest->title}}" class="w-full h-full object-cover opacity-30">
            @endif
            <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/60 to-black/30"></div>
            <div class="absolute inset-0 bg-black/20"></div>
        </div>
        
        <!-- Animated background elements -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute -top-40 -right-40 w-80 h-80 bg-purple-500/20 rounded-full blur-3xl animate-pulse"></div>
            <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-blue-500/20 rounded-full blur-3xl animate-pulse delay-1000"></div>
        </div>
        
        <div class="relative z-10 h-full flex items-center">
            <div class="container mx-auto px-4">
                <div class="text-center text-white">
                    <div class="mb-12">
                        <h1 class="text-6xl md:text-8xl lg:text-9xl font-black mb-8 bg-gradient-to-r from-white via-purple-100 to-blue-100 bg-clip-text text-transparent leading-tight tracking-tight">
                            {{$fest->title}}
                        </h1>
                        <div class="w-32 h-2 bg-gradient-to-r from-purple-500 via-pink-500 to-blue-500 rounded-full mx-auto mb-8 shadow-lg"></div>
                        
                        @php
                            $latestEventEndDate = $events->max('end_date');
                            $isEventOver = $latestEventEndDate && \Carbon\Carbon::parse($latestEventEndDate)->isPast();
                        @endphp
                        
                        @if($isEventOver && count($events) > 0)
                        <div class="mb-8">
                            <div class="bg-red-500/20 backdrop-blur-lg border border-red-400/30 px-6 py-3 rounded-full flex items-center justify-center shadow-xl max-w-md mx-auto">
                                <i class="bi bi-clock-history text-red-300 mr-3 text-lg"></i>
                                <span class="text-red-100 font-semibold text-lg">Fest Ended !</span>
                            </div>
                        </div>
                        @endif
                    </div>
                    
                    <div class="flex flex-wrap justify-center gap-6 mb-12">
                        @if($fest->location)
                        <div class="bg-white/15 backdrop-blur-lg border border-white/30 px-8 py-4 rounded-full flex items-center shadow-xl">
                            <i class="bi bi-geo-alt-fill text-purple-300 mr-3 text-lg"></i>
                            <span class="text-white font-semibold text-lg">{{$fest->location}}</span>
                        </div>
                        @endif
                        
                        <div class="bg-white/15 backdrop-blur-lg border border-white/30 px-8 py-4 rounded-full flex items-center shadow-xl">
                            <i class="bi bi-calendar-event text-blue-300 mr-3 text-lg"></i>
                            <span class="text-white font-semibold text-lg">{{ count($events) }} Events</span>
                        </div>
                        
                        @if($fest->start_date && $fest->end_date)
                        <div class="bg-white/15 backdrop-blur-lg border border-white/30 px-8 py-4 rounded-full flex items-center shadow-xl">
                            <i class="bi bi-clock text-green-300 mr-3 text-lg"></i>
                            <span class="text-white font-semibold text-lg">
                                {{ \Carbon\Carbon::parse($fest->start_date)->format('M j') }} - 
                                {{ \Carbon\Carbon::parse($fest->end_date)->format('M j, Y') }}
                            </span>
                        </div>
                        @endif
                    </div>
                    
                    <div class="flex flex-wrap justify-center gap-4">
                        <a href="#events" class="bg-gradient-to-r from-purple-600 to-blue-600 hover:from-purple-700 hover:to-blue-700 text-white px-6 py-3 rounded-full font-semibold transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-purple-500/25">
                            <i class="bi bi-calendar-check mr-2"></i>
                            Explore Events
                        </a>
                        @if($fest_images->count() > 0)
                        <a href="#gallery" class="bg-white/15 backdrop-blur-lg border-2 border-white/40 hover:bg-white/25 text-white px-6 py-3 rounded-full font-semibold transition-all duration-300 shadow-lg">
                            <i class="bi bi-images mr-2"></i>
                            View Gallery
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Scroll indicator -->
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
            <div class="w-6 h-10 border-2 border-white/50 rounded-full flex justify-center">
                <div class="w-1 h-3 bg-white/70 rounded-full mt-2 animate-pulse"></div>
            </div>
        </div>
    </section>


    <!-- Festival Details Section -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">
                <div class="text-center mb-16">
                    <h2 class="text-4xl font-bold text-gray-800 mb-4">About {{$fest->title}}</h2>
                    <div class="w-24 h-1 bg-gradient-to-r from-purple-500 to-blue-500 rounded-full mx-auto"></div>
                </div>
                
                <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed">
                    @if($fest->description)
                        {!! Str::markdown($fest->description) !!}
                    @else
                        <p class="text-xl text-center text-gray-500 py-12">
                            Festival details coming soon...
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Events Section -->
    <section id="events" class="bg-white">
        @if(count($events) > 0)
            @foreach($events as $index => $event)
            <div class="min-h-[85vh] flex items-center py-16 {{ $index % 2 == 0 ? 'bg-gradient-to-br from-gray-50 to-purple-50' : 'bg-gradient-to-bl from-blue-50 to-gray-50' }}">
                <div class="container mx-auto px-4">
                    <div class="grid lg:grid-cols-2 gap-12 items-center {{ $index % 2 == 1 ? 'lg:grid-flow-col-dense' : '' }}">
                        <!-- Event Image -->
                        <div class="relative {{ $index % 2 == 1 ? 'lg:col-start-2' : '' }}">
                            <div class="relative h-96 lg:h-[500px] rounded-3xl overflow-hidden shadow-2xl group">
                                @if($event->image)
                                    <img src="{{ $event->image }}" alt="{{ $event->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                                @else
                                    <div class="w-full h-full bg-gradient-to-br from-purple-500 via-blue-600 to-indigo-600 flex items-center justify-center">
                                        <div class="text-center text-white">
                                            <i class="bi bi-calendar-event text-8xl mb-4 opacity-80"></i>
                                            <p class="text-2xl font-bold mb-2">Event Poster</p>
                                            <p class="text-lg opacity-80">Coming Soon</p>
                                        </div>
                                    </div>
                                @endif
                                
                                <!-- Image Overlay with Quick Info -->
                                <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    <div class="absolute bottom-6 left-6 right-6 text-white">
                                        <div class="flex flex-wrap gap-3">
                                            <div class="bg-white/20 backdrop-blur-sm px-4 py-2 rounded-full text-sm font-semibold">
                                                {{ \Carbon\Carbon::parse($event->start_date)->format('M j, Y') }}
                                            </div>
                                            @if($event->registration_fee)
                                            <div class="bg-green-500/80 backdrop-blur-sm px-4 py-2 rounded-full text-sm font-semibold">
                                                BDT {{ $event->registration_fee }}
                                            </div>
                                            @endif
                                            @if($event->location)
                                            <div class="bg-purple-500/80 backdrop-blur-sm px-4 py-2 rounded-full text-sm font-semibold">
                                                <i class="bi bi-geo-alt-fill mr-1"></i>{{ Str::limit($event->location, 15) }}
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Event Details -->
                        <div class="{{ $index % 2 == 1 ? 'lg:col-start-1' : '' }}">
                            <div class="space-y-6">
                                <!-- Event Number -->
                                <div class="flex items-center space-x-4">
                                    <div class="w-12 h-12 bg-gradient-to-r from-purple-600 to-blue-600 rounded-full flex items-center justify-center text-white font-bold text-lg">
                                        {{ $index + 1 }}
                                    </div>
                                    <div class="h-px bg-gradient-to-r from-purple-600 to-blue-600 flex-1"></div>
                                </div>
                                
                                <!-- Event Title -->
                                <h2 class="text-4xl lg:text-5xl font-bold text-gray-800 leading-tight">
                                    {{ $event->title }}
                                </h2>
                                
                                <!-- Event Description -->
                                @if($event->description)
                                <div class="text-lg text-gray-600 leading-relaxed">
                                    <p>{{ Str::limit(strip_tags(Str::markdown($event->description)), 180) }}</p>
                                </div>
                                @endif
                                
                                <!-- Event Meta Information -->
                                <div class="flex flex-wrap gap-2">
                                    @if($event->medium)
                                    <!-- Format Card -->
                                    <div class="px-3 py-2 bg-blue-50 text-blue-700 rounded-md text-sm font-medium border border-blue-100">
                                        {{ $event->medium }}
                                    </div>
                                    @endif
                                    
                                    @if($event->min_team_size || $event->max_team_size)
                                    <!-- Team Size Card -->
                                    <div class="px-3 py-2 bg-green-50 text-green-700 rounded-md text-sm font-medium border border-green-100">
                                        @if($event->min_team_size == 1 && $event->max_team_size == 1)
                                            Solo
                                        @elseif($event->min_team_size && $event->max_team_size)
                                            {{ $event->min_team_size }}-{{ $event->max_team_size }} members
                                        @elseif($event->max_team_size)
                                            Up to {{ $event->max_team_size }} members
                                        @else
                                            {{ $event->min_team_size }}+ members
                                        @endif
                                    </div>
                                    @endif
                                    
                                    @if($event->registration_fee)
                                    <!-- Fee Card -->
                                    <div class="px-3 py-2 bg-purple-50 text-purple-700 rounded-md text-sm font-medium border border-purple-100">
                                        ৳{{ $event->registration_fee }}
                                    </div>
                                    @endif
                                    
                                    @if($event->registration_closing_date)
                                    <!-- Deadline Card -->
                                    <div class="px-3 py-2 bg-red-50 text-red-700 rounded-md text-sm font-medium border border-red-100">
                                        Deadline: {{ \Carbon\Carbon::parse($event->registration_closing_date)->format('M j') }}
                                    </div>
                                    @endif
                                    
                                    @if($event->location)
                                    <!-- Location Card -->
                                    <div class="px-3 py-2 bg-gray-50 text-gray-700 rounded-md text-sm font-medium border border-gray-100">
                                        {{ Str::limit($event->location, 25) }}
                                    </div>
                                    @endif
                                </div>
   
                                <!-- Action Buttons -->
                                <div class="flex flex-wrap gap-4 pt-6">
                                    <a href="/fest/{{$fest->id}}/event/{{$event->id}}" 
                                       class="bg-gradient-to-r from-purple-600 to-blue-600 hover:from-purple-700 hover:to-blue-700 text-white px-8 py-4 rounded-xl font-bold text-lg transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-purple-500/25 flex items-center">
                                        <i class="bi bi-arrow-right-circle mr-2"></i>
                                        View Details
                                    </a>
                                    
                                    @if($event->registration_link)
                                    <a href="{{ $event->registration_link }}" target="_blank"
                                       class="bg-white border-2 border-purple-600 text-purple-600 hover:bg-purple-600 hover:text-white px-8 py-4 rounded-xl font-bold text-lg transition-all duration-300 transform hover:scale-105 shadow-lg flex items-center">
                                        <i class="bi bi-person-plus mr-2"></i>
                                        Register Now
                                    </a>
                                    @endif
                                </div>
                                
                                @if(session('role') == 'admin')
                                <div class="pt-4 border-t border-gray-200">
                                    <a href="/admin/fest/{{$fest->id}}/event/{{$event->id}}/edit" class="text-purple-600 hover:text-purple-800 font-medium">
                                        <i class="bi bi-pencil mr-1"></i>Edit Event
                                    </a>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        @else
            <div class="min-h-[85vh] flex items-center justify-center bg-gradient-to-br from-gray-50 to-purple-50">
                <div class="text-center max-w-md mx-auto px-4">
                    <div class="w-32 h-32 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-8">
                        <i class="bi bi-calendar-x text-6xl text-gray-400"></i>
                    </div>
                    <h2 class="text-4xl font-bold text-gray-700 mb-6">No Events Yet</h2>
                    <p class="text-xl text-gray-500 mb-8 leading-relaxed">Events for this festival haven't been announced yet. Check back soon!</p>
                    
                    @if(session('role') == 'admin')
                    <a href="/admin/fest/{{$fest->id}}/event/create" class="bg-gradient-to-r from-purple-600 to-blue-600 hover:from-purple-700 hover:to-blue-700 text-white px-8 py-4 rounded-xl font-bold text-lg transition-all duration-300 transform hover:scale-105 shadow-lg">
                        <i class="bi bi-plus-circle mr-2"></i>Create First Event
                    </a>
                    @endif
                </div>
            </div>
        @endif
    </section>

    <!-- Gallery Section - Captured Moments -->
    @if($fest_images->count() > 0)
    <section id="gallery" class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-800 mb-4">Captured Moments</h2>
                <div class="w-24 h-1 bg-gradient-to-r from-purple-500 to-blue-500 rounded-full mx-auto mb-6"></div>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Relive the excitement and energy through these memorable moments from our events.
                </p>
            </div>
            
            <!-- Gallery Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($fest_images as $index => $image)
                <div class="group relative overflow-hidden rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 {{ $index % 7 == 0 ? 'md:col-span-2 md:row-span-2' : ($index % 5 == 0 ? 'lg:col-span-2' : '') }}">
                    <div class="relative h-64 {{ $index % 7 == 0 ? 'md:h-full' : ($index % 5 == 0 ? 'h-48' : '') }} overflow-hidden">
                        <img src="{{ asset($image->image_path) }}" 
                             alt="{{ $image->alt_text ?? 'Festival moment' }}" 
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                             loading="lazy">
                        
                        <!-- Overlay -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        
                        <!-- Image info overlay -->
                        <div class="absolute bottom-0 left-0 right-0 p-4 text-white transform translate-y-full group-hover:translate-y-0 transition-transform duration-300">
                            @if($image->caption)
                            <p class="text-sm font-medium mb-1">{{ $image->caption }}</p>
                            @endif
                            {{-- @if($image->original_name)
                            <p class="text-xs opacity-75">{{ $image->original_name }}</p>
                            @endif --}}
                        </div>
                        
                        <!-- Zoom icon -->
                        <div class="absolute top-4 right-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <div class="bg-white/20 backdrop-blur-sm rounded-full p-2">
                                <i class="bi bi-zoom-in text-white text-lg"></i>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            
            <!-- View more button if there are many images -->
            @if($fest_images->count() > 12)
            <div class="text-center mt-12">
                <button id="loadMoreGallery" class="bg-gradient-to-r from-purple-600 to-blue-600 hover:from-purple-700 hover:to-blue-700 text-white px-8 py-3 rounded-full font-semibold transition-all duration-300 transform hover:scale-105 shadow-lg">
                    Load More Images
                    <i class="bi bi-arrow-down ml-2"></i>
                </button>
            </div>
            @endif
        </div>
    </section>
    @endif
</div>

<!-- Lightbox Modal for Gallery -->
<div id="lightboxModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/90 backdrop-blur-sm">
    <div class="relative max-w-7xl max-h-full p-4">
        <button id="closeLightbox" class="absolute top-4 right-4 text-white hover:text-purple-300 transition-colors z-10">
            <i class="bi bi-x-lg text-3xl"></i>
        </button>
        
        <img id="lightboxImage" src="" alt="" class="max-w-full max-h-full object-contain rounded-lg">
        
        <div id="lightboxCaption" class="absolute bottom-4 left-4 right-4 text-white text-center bg-black/50 backdrop-blur-sm rounded-lg p-4 hidden">
            <p class="font-medium"></p>
        </div>
        
        <!-- Navigation arrows -->
        <button id="prevImage" class="absolute left-4 top-1/2 transform -translate-y-1/2 text-white hover:text-purple-300 transition-colors">
            <i class="bi bi-chevron-left text-4xl"></i>
        </button>
        <button id="nextImage" class="absolute right-4 top-1/2 transform -translate-y-1/2 text-white hover:text-purple-300 transition-colors">
            <i class="bi bi-chevron-right text-4xl"></i>
        </button>
    </div>
</div>

<style>
/* Custom animations and styles */
@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-20px); }
}

.animate-float {
    animation: float 6s ease-in-out infinite;
}

/* Smooth scrolling */
html {
    scroll-behavior: smooth;
}

/* Gallery hover effects */
.gallery-item {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.gallery-item:hover {
    transform: translateY(-8px) scale(1.02);
}

/* Prose styling for festival description */
.prose h1, .prose h2, .prose h3, .prose h4, .prose h5, .prose h6 {
    color: #374151;
    font-weight: 700;
    margin-top: 2rem;
    margin-bottom: 1rem;
}

.prose p {
    margin-bottom: 1.5rem;
    line-height: 1.75;
}

.prose ul, .prose ol {
    margin-bottom: 1.5rem;
    padding-left: 1.5rem;
}

.prose li {
    margin-bottom: 0.5rem;
}

.prose blockquote {
    border-left: 4px solid #8b5cf6;
    padding-left: 1rem;
    margin: 2rem 0;
    font-style: italic;
    color: #6b7280;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .hero-title {
        font-size: 3rem !important;
    }
    
    .gallery-grid {
        grid-template-columns: 1fr !important;
    }
    
    .gallery-item.md\:col-span-2,
    .gallery-item.lg\:col-span-2 {
        grid-column: span 1 !important;
    }
    
    .gallery-item.md\:row-span-2 {
        grid-row: span 1 !important;
    }
}

/* Loading animation for images */
.image-loading {
    background: linear-gradient(90deg, #f3f4f6 25%, #e5e7eb 50%, #f3f4f6 75%);
    background-size: 200% 100%;
    animation: loading 1.5s infinite;
}

@keyframes loading {
    0% { background-position: 200% 0; }
    100% { background-position: -200% 0; }
}

/* Accessibility improvements */
.focus\:outline-purple:focus {
    outline: 2px solid #8b5cf6;
    outline-offset: 2px;
}

/* High contrast mode support */
@media (prefers-contrast: high) {
    .bg-gradient-to-br,
    .bg-gradient-to-r {
        background: #ffffff !important;
        color: #000000 !important;
        border: 2px solid #000000 !important;
    }
}

/* Reduced motion support */
@media (prefers-reduced-motion: reduce) {
    *, *::before, *::after {
        animation-duration: 0.01ms !important;
        animation-iteration-count: 1 !important;
        transition-duration: 0.01ms !important;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Gallery lightbox functionality
    const galleryImages = document.querySelectorAll('#gallery img');
    const lightboxModal = document.getElementById('lightboxModal');
    const lightboxImage = document.getElementById('lightboxImage');
    const lightboxCaption = document.getElementById('lightboxCaption');
    const closeLightbox = document.getElementById('closeLightbox');
    const prevImage = document.getElementById('prevImage');
    const nextImage = document.getElementById('nextImage');
    
    let currentImageIndex = 0;
    const images = Array.from(galleryImages);
    
    // Open lightbox
    galleryImages.forEach((img, index) => {
        img.addEventListener('click', () => {
            currentImageIndex = index;
            showImage(currentImageIndex);
            lightboxModal.classList.remove('hidden');
            lightboxModal.classList.add('flex');
        });
    });
    
    // Close lightbox
    closeLightbox.addEventListener('click', closeLightboxModal);
    lightboxModal.addEventListener('click', (e) => {
        if (e.target === lightboxModal) {
            closeLightboxModal();
        }
    });
    
    // Navigation
    prevImage.addEventListener('click', () => {
        currentImageIndex = (currentImageIndex - 1 + images.length) % images.length;
        showImage(currentImageIndex);
    });
    
    nextImage.addEventListener('click', () => {
        currentImageIndex = (currentImageIndex + 1) % images.length;
        showImage(currentImageIndex);
    });
    
    // Keyboard navigation
    document.addEventListener('keydown', (e) => {
        if (!lightboxModal.classList.contains('hidden')) {
            if (e.key === 'Escape') {
                closeLightboxModal();
            } else if (e.key === 'ArrowLeft') {
                prevImage.click();
            } else if (e.key === 'ArrowRight') {
                nextImage.click();
            }
        }
    });
    
    function showImage(index) {
        const img = images[index];
        lightboxImage.src = img.src;
        lightboxImage.alt = img.alt;
        
        // Show caption if available
        const caption = img.closest('.group').querySelector('.absolute.bottom-0 p');
        if (caption && caption.textContent.trim()) {
            lightboxCaption.querySelector('p').textContent = caption.textContent.trim();
            lightboxCaption.classList.remove('hidden');
        } else {
            lightboxCaption.classList.add('hidden');
        }
    }
    
    function closeLightboxModal() {
        lightboxModal.classList.add('hidden');
        lightboxModal.classList.remove('flex');
    }
    
    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
    
    // Image lazy loading with loading animation
    const imageObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                img.classList.add('image-loading');
                
                const actualImg = new Image();
                actualImg.onload = () => {
                    img.src = actualImg.src;
                    img.classList.remove('image-loading');
                };
                actualImg.src = img.dataset.src || img.src;
                
                imageObserver.unobserve(img);
            }
        });
    });
    
    document.querySelectorAll('img[loading="lazy"]').forEach(img => {
        imageObserver.observe(img);
    });
    
    // Load more gallery functionality
    const loadMoreBtn = document.getElementById('loadMoreGallery');
    if (loadMoreBtn) {
        let visibleImages = 12;
        const allGalleryItems = document.querySelectorAll('#gallery .group');
        
        // Initially hide images beyond the first 12
        allGalleryItems.forEach((item, index) => {
            if (index >= visibleImages) {
                item.style.display = 'none';
            }
        });
        
        loadMoreBtn.addEventListener('click', () => {
            const hiddenImages = Array.from(allGalleryItems).slice(visibleImages, visibleImages + 8);
            hiddenImages.forEach(item => {
                item.style.display = 'block';
                item.style.animation = 'fadeInUp 0.6s ease forwards';
            });
            
            visibleImages += 8;
            
            if (visibleImages >= allGalleryItems.length) {
                loadMoreBtn.style.display = 'none';
            }
        });
    }
});

// Intersection Observer for animations
const animationObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.style.animation = 'fadeInUp 0.6s ease forwards';
        }
    });
}, { threshold: 0.1 });

document.querySelectorAll('.group, .prose').forEach(el => {
    animationObserver.observe(el);
});
</script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
@endsection
