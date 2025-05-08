@extends('layouts.main')

@section('main')
{{-- <main>
  <div class="container-fluid sh-hero">
    <div class="row sh-flex">
      <div class="col-md-10 offset-md-2 " class='' >
      </div>
    </div>
  </div>

  <div class="container vh-70">
    <div class="row mt-4">
      <div class="col-md-12">
        <h1 class="display-3">{{$fest->title}}</h1>
      </div>
    </div>
  </div>
</main>

<style>
  .sh-hero {
    background-image: linear-gradient(to top, rgba(0, 0, 0, 1), rgba(0, 0, 0, 0)), url("{{$fest->image}}");
    background-size: cover;
    background-position: center;
    height: 60vh;
    position: relative;


  }

  .sh-flex {
    display: flex;
    flex-direction: column;
    justify-content: end;
    align-items: start;
  }
</style> --}}


<div class="container py-5">
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

<style>
.hero-image {
        max-height: 500px;
        overflow: hidden;
    }
    
    .hero-image img {
        object-fit: cover;
        height: 100%;
    }
    
    .card {
        border: none;
        border-radius: 12px;
    }
    
    .content img {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
    }
    
    .event-card {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    
    .event-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }
    
    .event-image {
        height: 180px;
        overflow: hidden;
    }
    
    .event-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
</style>

<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

@endsection
