@extends('layouts.main')

@section('main')
<main>
    <!-- Hero Section -->
    <section class="relative bg-navy text-white py-32 lg:py-48 overflow-hidden">
        <div class="absolute inset-0">
            <div class="absolute inset-0 bg-gradient-to-br from-navy/90 via-navy/80 to-cyan/20"></div>
            <div class="hero-pattern"></div>
            {{-- <video autoplay loop muted playsinline class="w-full h-full object-cover opacity-30">
                <source src="https://videocdn.cdnpk.net/joy/video/free/2024-01/large/240110_01_4k_002.mp4" type="video/mp4">
            </video> --}}
        </div>
        <div class="container mx-auto px-4 relative z-10 text-center">
            <div class="hero-content">
                <h1 class="text-5xl md:text-7xl font-bold mb-6 leading-tight text-white hero-title">
                    IUT Computer Society
                </h1>
                <div class="flex justify-center mb-6">
                    <div class="h-1 w-32 bg-gradient-to-r from-cyan to-red rounded-full"></div>
                </div>
                <p class="text-xl md:text-2xl text-gray-200 max-w-4xl mx-auto mb-8 leading-relaxed">
                    Empowering future technology leaders since <span class="text-cyan font-bold">2008</span>. 
                    A platform for young computer engineers and students to develop their technical skills, 
                    collaborate on projects, and engage with the wider technology community.
                </p>
                <div class="hero-stats mb-10">
                    <div class="flex justify-center flex-wrap gap-8 text-center">
                        <div class="stat-item">
                            <div class="text-3xl font-bold text-cyan">17+</div>
                            <div class="text-sm text-gray-300">Years of Excellence</div>
                        </div>
                        <div class="stat-item">
                            <div class="text-3xl font-bold text-cyan">1000+</div>
                            <div class="text-sm text-gray-300">Active Members</div>
                        </div>
                        <div class="stat-item">
                            <div class="text-3xl font-bold text-cyan">30+</div>
                            <div class="text-sm text-gray-300">Events Annually</div>
                        </div>
                    </div>
                </div>
                <div class="flex justify-center flex-wrap gap-4">
                    <a href="/fests" class="bg-red hover:bg-red/90 text-white px-8 py-4 rounded-full font-semibold transition-all transform hover:scale-105 shadow-lg hover:shadow-xl">
                        Explore Fests
                    </a>
                    <a href="#about" class="bg-transparent border-2 border-cyan hover:bg-cyan/10 text-white px-8 py-4 rounded-full font-semibold transition-all">
                      Learn More
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- About IUTCS Section -->
    <section id="about" class="py-20 md:py-28 bg-white relative overflow-hidden">
        <div class="absolute top-0 right-0 w-96 h-96 bg-gradient-to-br from-cyan/5 to-transparent rounded-full transform translate-x-48 -translate-y-48"></div>
        <div class="container mx-auto px-4 relative z-10">
            <div class="max-w-6xl mx-auto">
                <div class="text-center mb-16">
                    <h2 class="text-4xl md:text-5xl font-bold text-navy mb-6">What is IUTCS?</h2>
                    <div class="flex justify-center mb-6">
                        <div class="h-1 w-24 bg-gradient-to-r from-cyan to-red rounded-full"></div>
                    </div>
                </div>
                <div class="grid md:grid-cols-2 gap-12 items-center">
                    <div class="order-2 md:order-1">
                        <div class="prose prose-lg text-gray-700 leading-relaxed">
                            <p class="text-xl mb-6">
                                The <span class="font-bold text-navy">IUT Computer Society (IUTCS)</span> is a prominent student organization at the Islamic University of Technology (IUT), founded in <span class="font-bold text-cyan">2008</span> by students from the Department of Computer Science and Engineering.
                            </p>
                            <p class="text-lg mb-6">
                                We serve as a platform for young computer engineers and students from <span class="font-bold text-navy">all departments</span> at IUT to develop their technical skills, collaborate on projects, and engage with the wider technology community.
                            </p>
                        </div>
                    </div>
                    <div class="order-1 md:order-2">
                        <div class="relative">
                            <div class="bg-gradient-to-br from-navy to-cyan p-8 rounded-2xl text-white shadow-2xl">
                                <h3 class="text-2xl font-bold mb-6">Quick Facts</h3>
                                <ul class="space-y-4">
                                    <li class="flex items-center">
                                        <div class="w-2 h-2 bg-red rounded-full mr-3"></div>
                                        <span>Founded in 2008</span>
                                    </li>
                                    <li class="flex items-center">
                                        <div class="w-2 h-2 bg-red rounded-full mr-3"></div>
                                        <span>Open to all IUT students</span>
                                    </li>
                                    <li class="flex items-center">
                                        <div class="w-2 h-2 bg-red rounded-full mr-3"></div>
                                        <span>Interdisciplinary collaboration</span>
                                    </li>
                                    <li class="flex items-center">
                                        <div class="w-2 h-2 bg-red rounded-full mr-3"></div>
                                        <span>9 specialized teams</span>
                                    </li>
                                    <li class="flex items-center">
                                        <div class="w-2 h-2 bg-red rounded-full mr-3"></div>
                                        <span>National recognition</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- What We Do Section -->
    <section class="py-20 md:py-28 bg-gradient-to-br from-gray-50 to-cyan/5">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-navy mb-6">What We Do</h2>
                <div class="flex justify-center mb-6">
                    <div class="h-1 w-24 bg-gradient-to-r from-cyan to-red rounded-full"></div>
                </div>
                <p class="text-xl text-gray-700 max-w-4xl mx-auto">
                    IUTCS is dedicated to nurturing technical excellence and innovation. Our comprehensive programs span education, competition, and collaboration.
                </p>
            </div>
            
            <!-- Core Activities -->
            <div class="mb-20">
                <div class="text-center mb-16">
                    <h3 class="text-3xl md:text-4xl font-bold text-navy mb-4">Core Activities</h3>
                    <div class="flex justify-center mb-6">
                        <div class="h-0.5 w-16 bg-gradient-to-r from-cyan to-red rounded-full"></div>
                    </div>
                    <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                        Building foundational skills through structured learning and hands-on experience
                    </p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- Activity Card -->
                    <div class="activity-card bg-white p-8 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border-t-4 border-cyan">
                        <div class="text-navy mb-6">
                            <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z"/>
                            </svg>
                        </div>
                        <h4 class="text-xl font-bold mb-3 text-navy">Programming & Development Classes</h4>
                        <p class="text-gray-600 leading-relaxed">Regular ACM-standard programming classes and comprehensive sessions on app and web development.</p>
                    </div>
                    
                    <!-- Activity Card -->
                    <div class="activity-card bg-white p-8 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border-t-4 border-red">
                        <div class="text-navy mb-6">
                            <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7 4a3 3 0 016 0v4a3 3 0 11-6 0V4zm4 10.93A7.001 7.001 0 0017 8a1 1 0 10-2 0A5 5 0 015 8a1 1 0 00-2 0 7.001 7.001 0 006 6.93V17H6a1 1 0 100 2h8a1 1 0 100-2h-3v-2.07z"/>
                            </svg>
                        </div>
                        <h4 class="text-xl font-bold mb-3 text-navy">Research Seminars</h4>
                        <p class="text-gray-600 leading-relaxed">Hosting seminars with industry professionals and academics on cutting-edge technologies and research.</p>
                    </div>
                    
                    <!-- Activity Card -->
                    <div class="activity-card bg-white p-8 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border-t-4 border-cyan">
                        <div class="text-navy mb-6">
                            <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z"/>
                            </svg>
                        </div>
                        <h4 class="text-xl font-bold mb-3 text-navy">Workshops & Projects</h4>
                        <p class="text-gray-600 leading-relaxed">Hands-on workshops and collaborative co-curricular projects providing practical experience.</p>
                    </div>
                </div>
            </div>

            <!-- Events & Competitions -->
            <div class="mb-20">
                <div class="text-center mb-16">
                    <h3 class="text-3xl md:text-4xl font-bold text-navy mb-4">Events & Competitions</h3>
                    <div class="flex justify-center mb-6">
                        <div class="h-0.5 w-16 bg-gradient-to-r from-red to-cyan rounded-full"></div>
                    </div>
                    <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                        Showcasing talent through competitive programming, innovation challenges, and flagship events
                    </p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                    <!-- Event Card -->
                    <div class="event-card bg-gradient-to-br from-navy to-cyan text-white p-8 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                        <div class="text-red mb-6">
                            <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <h4 class="text-xl font-bold mb-3">Programming Contests</h4>
                        <p class="text-gray-200 leading-relaxed">Competitive coding events designed to enhance algorithmic thinking and problem-solving skills.</p>
                    </div>
                    
                    <!-- Event Card -->
                    <div class="event-card bg-gradient-to-br from-red to-navy text-white p-8 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                        <div class="text-cyan mb-6">
                            <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z"/>
                            </svg>
                        </div>
                        <h4 class="text-xl font-bold mb-3">Hackathons</h4>
                        <p class="text-gray-200 leading-relaxed">Intensive innovation marathons including Bangladesh's first university-level game jam.</p>
                    </div>
                    
                    <!-- Event Card -->
                    <div class="event-card bg-gradient-to-br from-cyan to-red text-white p-8 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                        <div class="text-navy mb-6">
                            <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                        </div>
                        <h4 class="text-xl font-bold mb-3">IUT ICT Fest</h4>
                        <p class="text-gray-200 leading-relaxed">Our flagship event, a landmark in Bangladesh's ICT scene since 2008.</p>
                    </div>
                </div>

                <!-- Additional Events with improved spacing and header -->
                <div class="text-center mb-8">
                    <h4 class="text-2xl font-bold text-navy mb-2">More Exciting Events</h4>
                    <p class="text-gray-600 text-sm">Expanding horizons through diverse competitions and tournaments</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="text-center p-6 bg-white rounded-xl shadow-md hover:shadow-lg transition-shadow">
                        <div class="text-2xl mb-2">🏆</div>
                        <h4 class="font-bold text-navy mb-2">IT Olympiads</h4>
                        <p class="text-sm text-gray-600">Knowledge-based competitions across IT domains</p>
                    </div>
                    <div class="text-center p-6 bg-white rounded-xl shadow-md hover:shadow-lg transition-shadow">
                        <div class="text-2xl mb-2">🎮</div>
                        <h4 class="font-bold text-navy mb-2">E-sports Tournaments</h4>
                        <p class="text-sm text-gray-600">Competitive gaming events for the community</p>
                    </div>
                    <div class="text-center p-6 bg-white rounded-xl shadow-md hover:shadow-lg transition-shadow">
                        <div class="text-2xl mb-2">💼</div>
                        <h4 class="font-bold text-navy mb-2">Business Case Competitions</h4>
                        <p class="text-sm text-gray-600">Entrepreneurship and business strategy challenges</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Previous Collaborations Section -->
    <section class="py-20 md:py-28 bg-white relative overflow-hidden">
        <div class="absolute top-0 left-0 w-96 h-96 bg-gradient-to-br from-red/5 to-transparent rounded-full transform -translate-x-48 -translate-y-48"></div>
        <div class="container mx-auto px-4 relative z-10">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-navy mb-6">Previous Collaborations</h2>
                <div class="flex justify-center mb-6">
                    <div class="h-1 w-24 bg-gradient-to-r from-cyan to-red rounded-full"></div>
                </div>
                <p class="text-xl text-gray-700 max-w-4xl mx-auto">
                    Our proud history of successful collaborations with leading technology companies and organizations.
                </p>
            </div>
            
            <!-- Collaboration Partners Grid -->
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mb-12">
                <!-- Robi Axiata -->
                <div class="partnership-item bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-2 border-l-4 border-cyan text-center">
                    <h4 class="text-lg font-bold text-navy mb-2">Robi Axiata</h4>
                    <p class="text-gray-600 text-sm">Strategic industry collaboration</p>
                </div>
                
                <!-- StreamsTech -->
                <div class="partnership-item bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-2 border-l-4 border-red text-center">
                    <h4 class="text-lg font-bold text-navy mb-2">StreamsTech</h4>
                    <p class="text-gray-600 text-sm">Technical webinar collaboration</p>
                </div>
                
                <!-- BDApps -->
                <div class="partnership-item bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-2 border-l-4 border-cyan text-center">
                    <h4 class="text-lg font-bold text-navy mb-2">BDApps</h4>
                    <p class="text-gray-600 text-sm">Competition sponsorship platform</p>
                </div>
                
                <!-- Brain Station 23 -->
                <div class="partnership-item bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-2 border-l-4 border-red text-center">
                    <h4 class="text-lg font-bold text-navy mb-2">Brain Station 23</h4>
                    <p class="text-gray-600 text-sm">Game development hackathon</p>
                </div>
                
                <!-- NetCom Learning -->
                <div class="partnership-item bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-2 border-l-4 border-cyan text-center">
                    <h4 class="text-lg font-bold text-navy mb-2">NetCom Learning</h4>
                    <p class="text-gray-600 text-sm">AI competition collaboration</p>
                </div>
                
                <!-- Bengali.AI -->
                <div class="partnership-item bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-2 border-l-4 border-red text-center">
                    <h4 class="text-lg font-bold text-navy mb-2">Bengali.AI</h4>
                    <p class="text-gray-600 text-sm">Research collaboration datathon</p>
                </div>
                
                <!-- Prime Bank -->
                <div class="partnership-item bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-2 border-l-4 border-cyan text-center">
                    <h4 class="text-lg font-bold text-navy mb-2">Prime Bank</h4>
                    <p class="text-gray-600 text-sm">First ICT Fest sponsor</p>
                </div>
                
                <!-- First Security Islami Bank -->
                <div class="partnership-item bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-2 border-l-4 border-red text-center">
                    <h4 class="text-lg font-bold text-navy mb-2">FSIBL</h4>
                    <p class="text-gray-600 text-sm">Event powering sponsor</p>
                </div>
            </div>
            
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div>
                    <h3 class="text-2xl font-bold text-navy mb-6">Collaboration Highlights</h3>
                    <div class="space-y-6">
                        <div class="partnership-item bg-gradient-to-r from-cyan/10 to-red/10 p-6 rounded-xl border-l-4 border-cyan">
                            <h4 class="text-lg font-bold text-navy mb-2">First University Game Jam</h4>
                            <p class="text-gray-700">Partnered with Brain Station 23 for Bangladesh's pioneering university-level game development hackathon.</p>
                        </div>
                        <div class="partnership-item bg-gradient-to-r from-red/10 to-cyan/10 p-6 rounded-xl border-l-4 border-red">
                            <h4 class="text-lg font-bold text-navy mb-2">National AI Competition</h4>
                            <p class="text-gray-700">Collaborated with NetCom Learning for Agent X, involving 50,000+ students across Bangladesh.</p>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="bg-gradient-to-br from-navy to-cyan p-8 rounded-2xl text-white shadow-2xl">
                        <h3 class="text-2xl font-bold mb-6">Collaboration Impact</h3>
                        <ul class="space-y-4">
                            
                            <li class="flex items-start">
                                <div class="w-2 h-2 bg-red rounded-full mt-2 mr-4 flex-shrink-0"></div>
                                <span>Industry-standard skill development</span>
                            </li>
                            <li class="flex items-start">
                                <div class="w-2 h-2 bg-red rounded-full mt-2 mr-4 flex-shrink-0"></div>
                                <span>National competition leadership</span>
                            </li>
                            <li class="flex items-start">
                                <div class="w-2 h-2 bg-red rounded-full mt-2 mr-4 flex-shrink-0"></div>
                                <span>Research collaboration opportunities</span>
                            </li>
                            <li class="flex items-start">
                                <div class="w-2 h-2 bg-red rounded-full mt-2 mr-4 flex-shrink-0"></div>
                                <span>Professional certification access</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Fest Section -->
    @if($featuredFest)
    <section class="py-16 md:py-24 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800">Featured Fest</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto mt-4">
                    Discover our flagship technology festival that brings together the brightest minds in computing.
                </p>
            </div>
            <div class="bg-gray-50 rounded-xl overflow-hidden shadow-lg max-w-5xl mx-auto md:flex">
                <div class="md:w-1/2">
                    <img src="{{ asset($featuredFest->image) }}" alt="{{ $featuredFest->title }}" class="w-full h-full object-cover">
                </div>
                <div class="p-6 md:p-8 md:w-1/2 flex flex-col justify-center">
                    <div class="flex flex-wrap gap-4 mb-4">
                        <span class="bg-purple-100 text-purple-800 px-3 py-1 rounded-full text-sm font-medium flex items-center">
                            <i class="bi bi-geo-alt-fill mr-2"></i>
                            {{ $featuredFest->location }}
                        </span>
                        <span class="bg-purple-100 text-purple-800 px-3 py-1 rounded-full text-sm font-medium flex items-center">
                            <i class="bi bi-calendar-fill mr-2"></i>
                            {{ \Carbon\Carbon::parse($featuredFest->start_date)->format('d M Y') }} - {{ \Carbon\Carbon::parse($featuredFest->end_date)->format('d M Y') }}
                        </span>
                    </div>
                    <h3 class="text-2xl font-bold mb-3 text-gray-900">{{$featuredFest->title}}</h3>
                    <p class="text-gray-600 mb-6 text-justify">
                        {{ Illuminate\Support\Str::limit($featuredFest->description, 200) }}
                    </p>
                    <div class="mt-auto flex justify-between items-center">
                        <div class="flex items-center">
                            <span class="text-gray-700 font-semibold">{{$event_count}} Events</span>
                        </div>
                        <a href="/fest/{{$featuredFest->id}}" class="flex items-center text-purple-600 font-bold hover:underline">
                            View Details <i class="bi bi-arrow-right ml-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    <!-- Leadership Section -->
    <section class="py-20 md:py-28 bg-gradient-to-br from-gray-50 to-red/5">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-navy mb-6">Our Leadership</h2>
                <div class="flex justify-center mb-6">
                    <div class="h-1 w-24 bg-gradient-to-r from-cyan to-red rounded-full"></div>
                </div>
                <p class="text-xl text-gray-700 max-w-4xl mx-auto">
                    Meet the visionary leaders who guide IUTCS towards excellence and innovation.
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 max-w-7xl mx-auto">
                <!-- Chief Patron -->
                <div class="leadership-card text-center bg-white p-8 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border-t-4 border-cyan">
                    <div class="relative mb-6">
                        <img src="https://www.iutoic-dhaka.edu/uploads/img/1605521291_1068.jpg" alt="Chief Patron" class="w-32 h-32 rounded-full mx-auto border-4 border-cyan/30 shadow-lg object-cover">
                        <div class="absolute -bottom-2 left-1/2 transform -translate-x-1/2 bg-cyan text-white px-3 py-1 rounded-full text-xs font-bold">
                            Chief Patron
                        </div>
                    </div>
                    <h3 class="text-lg font-bold text-navy mb-2">Prof. Dr. Mohammad Rafiqul Islam</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">Vice Chancellor, Islamic University of Technology (IUT)</p>
                </div>
                
                <!-- Chairman -->
                <div class="leadership-card text-center bg-white p-8 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border-t-4 border-red">
                    <div class="relative mb-6">
                        <img src="https://cse.iutoic-dhaka.edu/uploads/img/1601046852_1755.jpg" alt="Chairman" class="w-32 h-32 rounded-full mx-auto border-4 border-red/30 shadow-lg">
                        <div class="absolute -bottom-2 left-1/2 transform -translate-x-1/2 bg-red text-white px-3 py-1 rounded-full text-xs font-bold">
                            Chairman
                        </div>
                    </div>
                    <h3 class="text-lg font-bold text-navy mb-2">Dr. Md. Hasanul Kabir</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">Professor and Head, CSE Department, IUT</p>
                </div>
                
                <!-- Moderator -->
                <div class="leadership-card text-center bg-white p-8 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border-t-4 border-cyan">
                    <div class="relative mb-6">
                        <img src="https://cse.iutoic-dhaka.edu/uploads/img/1727449400_1902.jpg" alt="Moderator" class="w-32 h-32 rounded-full mx-auto border-4 border-cyan/30 shadow-lg">
                        <div class="absolute -bottom-2 left-1/2 transform -translate-x-1/2 bg-cyan text-white px-3 py-1 rounded-full text-xs font-bold">
                            Moderator
                        </div>
                    </div>
                    <h3 class="text-lg font-bold text-navy mb-2">Dr. Hasan Mahmud</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">Professor, CSE Department, IUT</p>
                </div>
                
                <!-- President -->
                <div class="leadership-card text-center bg-white p-8 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border-t-4 border-red">
                    <div class="relative mb-6">
                        <img src="/rsx/samin.jpg" alt="President" class="w-32 h-32 rounded-full mx-auto border-4 border-red/30 shadow-lg object-cover">
                        <div class="absolute -bottom-2 left-1/2 transform -translate-x-1/2 bg-red text-white px-3 py-1 rounded-full text-xs font-bold">
                            President
                        </div>
                    </div>
                    <h3 class="text-lg font-bold text-navy mb-2">Kazi Samin Yasar Alam</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">President, IUT Computer Society</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Alumni Section -->
    <section class="py-20 md:py-28 bg-white relative overflow-hidden">
        <div class="absolute top-0 right-0 w-96 h-96 bg-gradient-to-br from-cyan/5 to-transparent rounded-full transform translate-x-48 -translate-y-48"></div>
        <div class="container mx-auto px-4 relative z-10">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-navy mb-6">Our Successful Alumni Network</h2>
                <div class="flex justify-center mb-6">
                    <div class="h-1 w-24 bg-gradient-to-r from-cyan to-red rounded-full"></div>
                </div>
                <p class="text-xl text-gray-700 max-w-4xl mx-auto">
                    IUTCS alumni have made significant contributions to the technology industry globally, representing excellence in AI, research, and innovation.
                </p>
            </div>
            
            <!-- Achievement Stats -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-16">
                <div class="text-center p-6 bg-gradient-to-br from-navy to-cyan text-white rounded-xl shadow-lg">
                    <div class="text-3xl font-bold mb-2" data-target="90" data-suffix="%+">90%+</div>
                    <div class="text-sm opacity-90">Job Placement Rate</div>
                </div>
                <div class="text-center p-6 bg-gradient-to-br from-red to-navy text-white rounded-xl shadow-lg">
                    <div class="text-3xl font-bold mb-2" data-target="15" data-suffix="+">15+</div>
                    <div class="text-sm opacity-90">Countries Worldwide</div>
                </div>
                <div class="text-center p-6 bg-gradient-to-br from-cyan to-red text-white rounded-xl shadow-lg">
                    <div class="text-3xl font-bold mb-2" data-target="50" data-suffix="+">50+</div>
                    <div class="text-sm opacity-90">Top Companies</div>
                </div>
            </div>
            
            <!-- Professional Domains -->
            <div class="mt-16 grid md:grid-cols-2 gap-12">
                <div>
                    <h3 class="text-2xl font-bold text-navy mb-6">Global Reach</h3>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between p-4 bg-gradient-to-r from-cyan/10 to-transparent rounded-lg">
                            <span class="font-semibold text-navy">🇺🇸 United States</span>
                            <span class="text-gray-600">Graduate Studies & Research</span>
                        </div>
                        <div class="flex items-center justify-between p-4 bg-gradient-to-r from-red/10 to-transparent rounded-lg">
                            <span class="font-semibold text-navy">🇨🇦 Canada</span>
                            <span class="text-gray-600">Advanced Academic Research</span>
                        </div>
                        <div class="flex items-center justify-between p-4 bg-gradient-to-r from-cyan/10 to-transparent rounded-lg">
                            <span class="font-semibold text-navy">🇩🇪 Germany</span>
                            <span class="text-gray-600">Engineering & IEEE Activities</span>
                        </div>
                        <div class="flex items-center justify-between p-4 bg-gradient-to-r from-red/10 to-transparent rounded-lg">
                            <span class="font-semibold text-navy">🇧🇩 Bangladesh</span>
                            <span class="text-gray-600">Leading Tech Companies</span>
                        </div>
                    </div>
                </div>
                <div>
                    <h3 class="text-2xl font-bold text-navy mb-6">Specialization Areas</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="text-center p-4 bg-gradient-to-br from-navy/10 to-cyan/10 rounded-lg">
                            <div class="text-2xl mb-2">🤖</div>
                            <div class="text-sm font-semibold text-navy">AI & ML</div>
                        </div>
                        <div class="text-center p-4 bg-gradient-to-br from-red/10 to-navy/10 rounded-lg">
                            <div class="text-2xl mb-2">🧬</div>
                            <div class="text-sm font-semibold text-navy">Bioinformatics</div>
                        </div>
                        <div class="text-center p-4 bg-gradient-to-br from-cyan/10 to-red/10 rounded-lg">
                            <div class="text-2xl mb-2">💻</div>
                            <div class="text-sm font-semibold text-navy">Software Engineering</div>
                        </div>
                        <div class="text-center p-4 bg-gradient-to-br from-navy/10 to-red/10 rounded-lg">
                            <div class="text-2xl mb-2">🔬</div>
                            <div class="text-sm font-semibold text-navy">Research & Academia</div>
                        </div>
                        <div class="text-center p-4 bg-gradient-to-br from-cyan/10 to-navy/10 rounded-lg">
                            <div class="text-2xl mb-2">🌐</div>
                            <div class="text-sm font-semibold text-navy">Network Technology</div>
                        </div>
                        <div class="text-center p-4 bg-gradient-to-br from-red/10 to-cyan/10 rounded-lg">
                            <div class="text-2xl mb-2">📊</div>
                            <div class="text-sm font-semibold text-navy">Data Analysis</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- <!-- References Section -->
    <section class="py-16 bg-gradient-to-r from-navy to-cyan text-white">
        <div class="container mx-auto px-4">
            <div class="text-center">
                <h3 class="text-2xl font-bold mb-6">About This Information</h3>
                <div class="max-w-4xl mx-auto">
                    <p class="text-lg leading-relaxed opacity-90 mb-6">
                        The information presented on this page is compiled from extensive research across professional platforms, 
                        academic records, and publicly available sources. Our data reflects the genuine achievements and contributions 
                        of IUTCS members and alumni in the global technology landscape.
                    </p>
                    <div class="bg-white/10 backdrop-blur-sm rounded-xl p-6 border border-white/20">
                        <p class="text-sm leading-relaxed">
                            <strong>Data Sources:</strong> Professional networking platforms, academic institutions, industry reports, 
                            and verified public records. Numbers and statistics are based on research conducted through 2024-2025.
                            For specific source inquiries or corrections, please contact us through our official channels.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}

</main>

<style>
/* Hero Section Animations */
.hero-pattern {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-image: 
        radial-gradient(circle at 20% 50%, rgba(0, 168, 232, 0.1) 0%, transparent 50%),
        radial-gradient(circle at 80% 20%, rgba(230, 57, 70, 0.1) 0%, transparent 50%),
        radial-gradient(circle at 40% 80%, rgba(0, 168, 232, 0.1) 0%, transparent 50%);
    animation: float 6s ease-in-out infinite;
}

.hero-content {
    animation: fadeInUp 1s ease-out;
}

.hero-title {
    background: linear-gradient(135deg, #ffffff 0%, #00a8e8 50%, #e63946 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    animation: textShine 3s ease-in-out infinite;
}

.hero-stats {
    animation: fadeInUp 1s ease-out 0.3s both;
}

.stat-item {
    transition: transform 0.3s ease;
}

.stat-item:hover {
    transform: scale(1.1);
}

/* Activity and Event Cards */
.activity-card {
    position: relative;
    overflow: hidden;
}

.activity-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(0, 168, 232, 0.1), transparent);
    transition: left 0.5s;
}

.activity-card:hover::before {
    left: 100%;
}

.event-card {
    position: relative;
    overflow: hidden;
}

.event-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
    transition: left 0.5s;
}

.event-card:hover::before {
    left: 100%;
}

/* Leadership Cards */
.leadership-card {
    position: relative;
    overflow: hidden;
}

.leadership-card::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, rgba(0, 168, 232, 0.05) 0%, rgba(230, 57, 70, 0.05) 100%);
    opacity: 0;
    transition: opacity 0.3s ease;
}

.leadership-card:hover::after {
    opacity: 1;
}

/* Partnership Items */
.partnership-item {
    position: relative;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.partnership-item:hover {
    transform: translateX(10px);
    box-shadow: 0 10px 25px rgba(0, 168, 232, 0.15);
}

/* Alumni Grid */
.alumni-grid {
    min-height: 400px;
}

.alumni-card {
    transition: all 0.3s ease;
    height: 100%;
}

.alumni-card:hover {
    transform: translateY(-5px);
}

.alumni-card-featured {
    min-height: 300px;
}

/* Responsive Grid Adjustments */
@media (max-width: 768px) {
    .alumni-grid {
        grid-template-columns: 1fr;
        gap: 1rem;
    }
    
    .alumni-card-featured {
        min-height: auto;
    }
    
    .alumni-grid .md\:col-span-2 {
        grid-column: span 1;
    }
    
    .alumni-grid .md\:row-span-2 {
        grid-row: span 1;
    }
}

/* Alumni Card Variants */
.alumni-card-featured .bg-gradient-to-br {
    background-image: linear-gradient(135deg, #0a1929 0%, #00a8e8 100%);
}

.alumni-card .border-l-4 {
    border-left-width: 4px;
}

.alumni-card .bg-gradient-to-br {
    background-attachment: fixed;
}

/* Animations */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes float {
    0%, 100% {
        transform: translateY(0px);
    }
    50% {
        transform: translateY(-20px);
    }
}

@keyframes textShine {
    0%, 100% {
        background-position: 0% 50%;
    }
    50% {
        background-position: 100% 50%;
    }
}

/* Scroll animations */
@keyframes slideInLeft {
    from {
        opacity: 0;
        transform: translateX(-50px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

@keyframes slideInRight {
    from {
        opacity: 0;
        transform: translateX(50px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

/* Intersection Observer animations */
.animate-on-scroll {
    opacity: 0;
    transform: translateY(30px);
    transition: opacity 0.6s ease, transform 0.6s ease;
}

.animate-on-scroll.animate {
    opacity: 1;
    transform: translateY(0);
}

/* Responsive Design */
@media (max-width: 768px) {
    .hero-title {
        font-size: 2.5rem;
    }
    
    .hero-stats {
        flex-direction: column;
        gap: 1rem;
    }
    
    .stat-item {
        padding: 1rem;
    }
}

/* Button hover effects */
.btn-hover-effect {
    position: relative;
    overflow: hidden;
}

.btn-hover-effect::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: left 0.5s;
}

.btn-hover-effect:hover::before {
    left: 100%;
}

/* Loading animation for images */
.img-loading {
    background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
    background-size: 200% 100%;
    animation: loading 1.5s infinite;
}

@keyframes loading {
    0% {
        background-position: 200% 0;
    }
    100% {
        background-position: -200% 0;
    }
}

/* Gradient text effects */
.gradient-text {
    background: linear-gradient(135deg, #0a1929 0%, #00a8e8 50%, #e63946 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

/* Section dividers */
.section-divider {
    height: 1px;
    background: linear-gradient(90deg, transparent, #00a8e8, #e63946, transparent);
    margin: 2rem 0;
}

/* Pulse animation for call-to-action elements */
.pulse-animation {
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0% {
        box-shadow: 0 0 0 0 rgba(0, 168, 232, 0.7);
    }
    70% {
        box-shadow: 0 0 0 10px rgba(0, 168, 232, 0);
    }
    100% {
        box-shadow: 0 0 0 0 rgba(0, 168, 232, 0);
    }
}

/* Smooth scrolling for the entire page */
html {
    scroll-behavior: smooth;
}

/* Focus styles for accessibility */
*:focus {
    outline: 2px solid #00a8e8;
    outline-offset: 2px;
}

/* High contrast mode support */
@media (prefers-contrast: high) {
    .bg-gradient-to-br,
    .bg-gradient-to-r {
        background: #ffffff;
        color: #000000;
        border: 2px solid #000000;
    }
}

/* Reduced motion support */
@media (prefers-reduced-motion: reduce) {
    *,
    *::before,
    *::after {
        animation-duration: 0.01ms !important;
        animation-iteration-count: 1 !important;
        transition-duration: 0.01ms !important;
    }
}
</style>

<script>
// Intersection Observer for scroll animations
document.addEventListener('DOMContentLoaded', function() {
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate');
            }
        });
    }, observerOptions);

    // Observe all sections
    document.querySelectorAll('section').forEach(section => {
        section.classList.add('animate-on-scroll');
        observer.observe(section);
    });
});

// Add dynamic counter animation
function animateCounter(element, target, suffix = '', duration = 2000) {
    let start = 0;
    const increment = target / (duration / 16);
    
    const timer = setInterval(() => {
        start += increment;
        element.textContent = Math.floor(start) + suffix;
        
        if (start >= target) {
            element.textContent = target + suffix;
            clearInterval(timer);
        }
    }, 16);
}

// Initialize counters when they come into view
const counterObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            const counter = entry.target.querySelector('.text-3xl');
            if (counter && counter.dataset.target) {
                const target = parseInt(counter.dataset.target);
                const suffix = counter.dataset.suffix || '';
                if (target) {
                    animateCounter(counter, target, suffix);
                }
            }
            counterObserver.unobserve(entry.target);
        }
    });
});

document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('[class*="bg-gradient-to-br"]').forEach(card => {
        if (card.querySelector('.text-3xl')) {
            counterObserver.observe(card);
        }
    });
});
</script>

@endsection