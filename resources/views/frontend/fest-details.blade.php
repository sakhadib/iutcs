@extends('layouts.main')

@section('main')
{{-- <div class="container py-5">
  <!-- Hero Section -->
  <div class="row mb-5">
      <div class="col-lg-8 mx-auto text-center">
          <h1 class="display-4 fw-bold mb-3">{{ $fest->title }}</h1>
          
          @if($fest->image)
          <div class="hero-image mb-4 rounded-3 overflow-hidden shadow-lg">
              <img src="{{$fest->image}}" alt="{{ $fest->title }}" class="img-fluid w-100">
          </div>
          @endif
      </div>
  </div>

  <!-- Main Content -->
  <div class="row">
      <!-- Event Details -->
      <div class="col-lg-8">
          <div class="card shadow-sm mb-4">
              <div class="card-body">
                  <h2 class="h4 card-title text-primary">Fest Details</h2>
                  <div class="mb-4">
                      {!! nl2br(e($fest->description)) !!}
                  </div>

                  <div class="row g-3">
                      <div class="col-md-6">
                          <div class="d-flex align-items-start">
                              <i class="bi bi-calendar-event fs-5 me-3 text-muted"></i>
                              <div>
                                  <h3 class="h6 mb-1">Start Date</h3>
                                    <p class="mb-0">{{ \Carbon\Carbon::parse($fest->start_date)->format('F j, Y \a\t g:i A') }}</p>
                              </div>
                          </div>
                      </div>

                      @if($fest->end_date)
                      <div class="col-md-6">
                          <div class="d-flex align-items-start">
                              <i class="bi bi-calendar-x fs-5 me-3 text-muted"></i>
                              <div>
                                  <h3 class="h6 mb-1">End Date</h3>
                                    <p class="mb-0">{{ \Carbon\Carbon::parse($fest->end_date)->format('F j, Y \a\t g:i A') }}</p>
                              </div>
                          </div>
                      </div>
                      @endif

                      @if($fest->location)
                      <div class="col-md-6">
                          <div class="d-flex align-items-start">
                              <i class="bi bi-geo-alt fs-5 me-3 text-muted"></i>
                              <div>
                                  <h3 class="h6 mb-1">Location</h3>
                                  <p class="mb-0">{{ $fest->location }}</p>
                              </div>
                          </div>
                      </div>
                      @endif

                      @if($fest->medium)
                      <div class="col-md-6">
                          <div class="d-flex align-items-start">
                              <i class="bi bi-collection fs-5 me-3 text-muted"></i>
                              <div>
                                  <h3 class="h6 mb-1">Medium</h3>
                                  <p class="mb-0">{{ $fest->medium }}</p>
                              </div>
                          </div>
                      </div>
                      @endif
                  </div>
              </div>
          </div>

          <!-- Additional Info Section -->
          @if($fest->additional_info)
          <div class="card shadow-sm mb-4">
              <div class="card-body">
                  <h2 class="h4 card-title text-primary">Additional Information</h2>
                  <div class="content">
                      {!! nl2br(e($fest->additional_info)) !!}
                  </div>
              </div>
          </div>
          @endif
      </div>

      <!-- Sidebar -->
      <div class="col-lg-4">
          <!-- Organizer Info -->
          <div class="card shadow-sm mb-4">
              <div class="card-body">
                  <h2 class="h4 card-title text-primary">Organizer</h2>
                  <div class="d-flex align-items-center mb-3">
                      <div class="flex-shrink-0">
                            <i class="bi bi-people fs-1 text-muted"></i>
                      </div>
                      <div class="flex-grow-1 ms-3">
                          <p class="mb-0">IUT Computer Society (IUTCS)</p>
                      </div>
                  </div>
              </div>
          </div>

          <!-- Event Meta -->
          <div class="card shadow-sm">
              <div class="card-body">
                  <h2 class="h4 card-title text-primary">Event Details</h2>
                  <ul class="list-unstyled">
                      <li class="mb-2">
                          <i class="bi bi-clock-history me-2 text-muted"></i>
                          Created: {{ $fest->created_at->diffForHumans() }}
                      </li>
                      <li class="mb-2">
                          <i class="bi bi-arrow-repeat me-2 text-muted"></i>
                          Updated: {{ $fest->updated_at->diffForHumans() }}
                      </li>
                  </ul>
              </div>
          </div>
      </div>
  </div>
</div>


<!-- Events Section -->
<div class="container py-5">
  <div class="row mb-4">
      <div class="col-lg-8 mx-auto text-center">
          <h1 class="display-4 fw-bold mb-3">Upcoming Events</h1>
          <p class="lead">Explore the exciting events happening during this festival.</p>

          @if(session('role') == 'admin')
          <div class="d-flex justify-content-center mb-3">
              <a href="/admin/fest/{{$fest->id}}/event/create" class="btn btn-dark">Create New Event</a>
          </div>
          @endif
      </div>
  </div>

  <!-- Events List -->
<div class="card shadow-sm mb-4">
  <div class="card-body">
      
      @if(count($events) > 0)
          <div class="row g-4">
              @foreach($events as $event)
              <div class="col-md-4">
                  <div class="card h-100 border-0 shadow-sm event-card">
                      @if($event->image)
                      <div class="event-image">
                          <img src="{{$event->image}}" class="card-img-top" alt="{{ $event->title }}">
                      </div>
                      @endif
                      <div class="card-body">
                          <h3 class="h4 card-title mb-3">{{ $event->title }}</h3>
                          
                          <div class="d-flex align-items-center mb-2">
                              <i class="bi bi-calendar-event me-2 text-muted"></i>
                                <small>Starts : {{ \Carbon\Carbon::parse($event->start_date)->format('M j, Y g:i A') }}</small>
                          </div>
                          
                          @if($event->end_date)
                          <div class="d-flex align-items-center mb-2">
                              <i class="bi bi-calendar-x me-2 text-muted"></i>
                                <small>Ends: {{ \Carbon\Carbon::parse($event->end_date)->format('M j, Y g:i A') }}</small>
                          </div>
                          @endif
                          
                          @if($event->location)
                          <div class="d-flex align-items-center mb-2">
                              <i class="bi bi-geo-alt me-2 text-muted"></i>
                              <small>{{ $event->location }}</small>
                          </div>
                          @endif
                          
                          <div class="d-flex justify-content-between mb-3">
                              @if($event->min_team_size || $event->max_team_size)
                              <div class="team-size">
                                  <i class="bi bi-people me-1 text-muted"></i>
                                  <small>
                                      @if($event->min_team_size && $event->max_team_size)
                                          Team: {{ $event->min_team_size }}-{{ $event->max_team_size }}
                                      @elseif($event->min_team_size)
                                          Min: {{ $event->min_team_size }}
                                      @else
                                          Max: {{ $event->max_team_size }}
                                      @endif
                                  </small>
                              </div>
                              @endif
                              
                              @if($event->registration_fee)
                              <div class="registration-fee">
                                  <small>BDT {{ $event->registration_fee }}</small>
                              </div>
                              @endif
                          </div>
                          
                          <div class="d-grid gap-2">
                              <a href="/fest/{{$fest->id}}/event/{{$event->id}}" class="btn btn-lg btn-outline-dark">
                                  View Details
                              </a>
                          </div>
                      </div>
                  </div>
              </div>
              @endforeach
          </div>
      @else
          <div class="alert alert-info">
              No events found for this festival.
          </div>
      @endif
  </div>
</div>
</div>
 --}}


 <div class="festival-page">
    <!-- Hero Section -->
    <div class="relative h-[80vh] bg-black">
      <img src="{{$fest->image}}" alt="Event Cover" class="w-full h-full object-cover opacity-75 bg-fixed">
      <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent"></div>
      <div class="absolute bottom-0 left-0 right-0 text-white p-8">
      <div class="container mx-auto">
        <h1 class="text-4xl md:text-6xl font-bold mb-4">{{$fest->title}}</h1>
        <div class="flex items-center space-x-4">
        <span class="bg-purple-600 text-sm px-3 py-1 rounded-full">
          <i class="bi bi-geo-alt-fill mr-2"></i>{{$fest->location}}
        </span>
        <span class="bg-green-600 text-sm px-3 py-1 rounded-full">
          <i class="bi bi-calendar-event mr-2"></i> {{ count($events) }} Events
        </span>
        </div>
      </div>
      </div>
    </div>



  <!-- Main Content -->
  <div class="container py-5">
      <div class="tab-content">
          <!-- Overview Tab -->
          <div class="tab-pane fade show active" id="overview">
              <div class="row g-5">
                  <div class="col-lg-12">
                      <div class="content-card">
                          <h3 class="section-title mb-4">Festival Details</h3>
                          <div class="prose">
                              {!! Str::markdown($fest->description) !!}
                          </div>
                      </div>
                  </div>                     
              </div>
          </div>

          <!-- Events Tab -->
          <div>
              <div class="d-flex justify-content-between align-items-center mb-4 mt-10">
                  <h3 class="section-title">Featured Events</h3>
                  @if(session('role') == 'admin')
                  <a href="/admin/fest/{{$fest->id}}/event/create" class="btn btn-dark">
                      <i class="bi bi-plus-circle me-2"></i>Add New Event
                  </a>
                  @endif
              </div>

              <div class="row g-4">
                  @if(count($events) > 0)
                      @foreach($events as $event)
                        <div class="col-md-6 col-lg-4">
                          <div class="event-card shadow-lg hover-lift transform transition-transform duration-300 hover:scale-105">
                          <div class="event-image relative overflow-hidden rounded-t-lg">
                            <img src="{{ $event->image }}" alt="{{ $event->title }}" class="w-full h-48 object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent opacity-75"></div>
                            <div class="absolute bottom-2 left-2 text-white text-sm bg-purple-600 px-2 py-1 rounded">
                            {{ \Carbon\Carbon::parse($event->start_date)->format('M j, Y') }}
                            </div>
                            <div class="absolute bottom-2 right-2 text-white text-sm bg-green-600 px-2 py-1 rounded">
                            {{ Str::limit($event->location, 25) }}
                            </div>
                            <div class="absolute top-2 right-2 text-white text-sm bg-indigo-600 px-2 py-1 rounded">
                            BDT {{ $event->registration_fee }}
                            </div>
                          </div>
                          <div class="event-body p-4 bg-white rounded-b-lg">
                            <h4 class="event-title text-lg font-semibold text-gray-800 mb-2">
                            {{ Str::limit($event->title, 40) }}
                            </h4>
                            <div class="d-grid">
                            <a href="/fest/{{$fest->id}}/event/{{$event->id}}" 
                               class="btn btn-lg btn-dark w-100">
                              View Event Page
                            </a>
                            </div>
                          </div>
                          </div>
                        </div>
                      @endforeach
                  @else
                      <div class="col-12">
                          <div class="empty-state">
                              <i class="bi bi-calendar-x"></i>
                              <p>No events announced yet</p>
                              @if(session('role') == 'admin')
                              <a href="/admin/fest/{{$fest->id}}/event/create" class="btn btn-dark mt-3">
                                  Create First Event
                              </a>
                              @endif
                          </div>
                      </div>
                  @endif
              </div>
          </div>
      </div>
  </div>
</div>

<style>
.hero-section {
  height: 70vh;
  min-height: 600px;
  background: linear-gradient(45deg, #0f172a, #1e293b);
}

.gradient-overlay {
  background: linear-gradient(to top, rgba(15, 23, 42, 1) 10%, rgba(15, 23, 42, 0.2) 100%);
  z-index: 1;
}

.hero-image {
  width: 100%;
  height: 100%;
  object-fit: cover;
  object-position: center;
  position: absolute;
  z-index: 0;
}

.hero-content {
  position: relative;
  z-index: 2;
}

.event-card {
  background: white;
  border-radius: 12px;
  overflow: hidden;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  position: relative;
  height: 100%;
  display: flex;
  flex-direction: column;
}

.event-image img {
  width: 100%;
  height: 200px;
  object-fit: cover;
}

.event-body {
  padding: 1.5rem;
  flex-grow: 1;
  display: flex;
  flex-direction: column;
}

.event-title {
  font-weight: 600;
  margin-bottom: 0.75rem;
  min-height: 3rem;
}

.event-meta {
  margin-bottom: auto;
}

.meta-item {
  font-size: 0.9rem;
  color: #64748b;
  margin-bottom: 0.5rem;
}

.empty-state {
  text-align: center;
  padding: 4rem;
  color: #64748b;
  border: 2px dashed #e2e8f0;
  border-radius: 12px;
}
</style>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
@endsection
