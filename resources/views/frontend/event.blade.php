@extends('layouts.main')

@section('main')
<div class="min-h-screen bg-gray-100">
  <!-- Hero Section -->
  <div class="relative h-[80vh] bg-black">
      <!-- Static Event Image -->
      <img src="{{ asset($object['event']['image']) }}" alt="Event Cover" class="w-full h-full object-cover opacity-75">
      <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent"></div>
      <div class="absolute bottom-0 left-0 right-0 text-white p-8">
          <div class="container mx-auto">
              <h1 class="text-4xl md:text-6xl font-bold mb-4">{{ $object['event']['title'] }}</h1>
              <div class="flex items-center space-x-4">
                  <span class="bg-purple-600 text-sm px-3 py-1 rounded-full">
                      <i class="bi bi-people-fill mr-2"></i>Registration Open
                  </span>
                  @if(session('role') == 'admin')
                      <a href="/admin/fest/{{ $object['fest']['id'] }}/event/{{ $object['event']['id'] }}/edit" class="btn btn-outline-light btn-sm">Edit Event</a>
                      <a href="/admin/fest/{{ $object['fest']['id'] }}/event/{{ $object['event']['id'] }}/form" class="btn btn-outline-light btn-sm">Edit Form</a>
                      <a href="/admin/fest/{{ $object['fest']['id'] }}/event/{{ $object['event']['id'] }}/participants" class="btn btn-outline-light btn-sm">Participants</a>
                  @endif
              </div>
          </div>
      </div>
  </div>

  <!-- Main Content -->
  <div class="container mx-auto px-4 py-12">
      <div class="row">
          <!-- Left Column -->
          <div class="col-lg-8 mb-8">
              <!-- Tab Navigation -->
              <nav class="mb-6">
                  <div class="nav nav-tabs" id="nav-tab" role="tablist">
                      <button class="nav-link active" id="nav-description-tab" data-bs-toggle="tab" data-bs-target="#nav-description" type="button" role="tab">
                          <i class="bi bi-journal-text me-2"></i>Description
                      </button>
                      <button class="nav-link" id="nav-rules-tab" data-bs-toggle="tab" data-bs-target="#nav-rules" type="button" role="tab">
                          <i class="bi bi-list-check me-2"></i>Rules
                      </button>
                      <button class="nav-link" id="nav-prizes-tab" data-bs-toggle="tab" data-bs-target="#nav-prizes" type="button" role="tab">
                          <i class="bi bi-trophy me-2"></i>Prizes
                      </button>
                      <button class="nav-link" id="nav-judges-tab" data-bs-toggle="tab" data-bs-target="#nav-judges" type="button" role="tab">
                          <i class="bi bi-person-badge me-2"></i>Judges
                      </button>
                      <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab">
                          <i class="bi bi-envelope me-2"></i>Contact
                      </button>
                  </div>
              </nav>

              <!-- Tab Content -->
              <div class="tab-content" id="nav-tabContent">
                  <div class="tab-pane fade show active" id="nav-description" role="tabpanel">
                      <div class="bg-white rounded-xl shadow-lg p-8 mb-6">
                          <div class="prose max-w-none">
                              {!! Str::markdown($object['event']['description']) !!}
                          </div>
                      </div>
                  </div>
                  <div class="tab-pane fade" id="nav-rules" role="tabpanel">
                      <div class="bg-white rounded-xl shadow-lg p-8 mb-6">
                          <div class="prose max-w-none">
                              {!! Str::markdown($object['event']['rules']) !!}
                          </div>
                      </div>
                  </div>
                  <div class="tab-pane fade" id="nav-prizes" role="tabpanel">
                      <div class="bg-white rounded-xl shadow-lg p-8 mb-6">
                          <div class="prose max-w-none">
                              {!! Str::markdown($object['event']['prizes']) !!}
                          </div>
                      </div>
                  </div>
                  <div class="tab-pane fade" id="nav-judges" role="tabpanel">
                      <div class="bg-white rounded-xl shadow-lg p-8 mb-6">
                          <div class="prose max-w-none">
                              {!! Str::markdown($object['event']['judges']) !!}
                          </div>
                      </div>
                  </div>
                  <div class="tab-pane fade" id="nav-contact" role="tabpanel">
                      <div class="bg-white rounded-xl shadow-lg p-8 mb-6">
                          <div class="prose max-w-none">
                              {!! Str::markdown($object['event']['contact']) !!}
                          </div>
                      </div>
                  </div>
              </div>

              <!-- Event Gallery Section -->
              @if($object['event']['eventImages'] && $object['event']['eventImages']->count() > 0)
                  <div class="mt-8">
                      <h3 class="text-2xl font-semibold mb-4 text-gray-800">
                          <i class="bi bi-images mr-2 text-indigo-600"></i>Event Gallery
                      </h3>
                      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                          @foreach($object['event']['eventImages'] as $image)
                              <div class="cursor-pointer" data-bs-toggle="modal" data-bs-target="#galleryModal" 
                                  data-image-src="{{ asset($image->image_path) }}"
                                  data-image-alt="{{ $image->alt_text ?? 'Event Image' }}">
                                  <div class="overflow-hidden rounded-lg shadow-md transition-all duration-300 hover:shadow-xl">
                                      <img
                                          src="{{ asset($image->image_path) }}"
                                          alt="{{ $image->alt_text ?? 'Event Image' }}"
                                          class="w-full h-64 object-cover transition-transform duration-500 hover:scale-105"
                                      />
                                  </div>
                              </div>
                          @endforeach
                      </div>
                  </div>
              @endif
          </div>

          <!-- Right Column (Sidebar) -->
          <div class="col-lg-4">
              <div class="sticky top-24">
                  <!-- Event Details Card -->
                  <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
                      <h3 class="text-xl font-bold mb-4">
                          <i class="bi bi-info-circle me-2"></i>Event Details
                      </h3>
                      <div class="space-y-3">
                          <div class="d-flex align-items-center">
                              <i class="bi bi-calendar-event me-3 text-purple-600"></i>
                              <div>
                                  <p class="text-sm text-muted mb-0">Dates</p>
                                  <p class="mb-0 fw-semibold">
                                      {{ date('M j, Y', strtotime($object['event']['start_date'])) }}
                                      -
                                      {{ date('M j, Y', strtotime($object['event']['end_date'])) }}
                                  </p>
                              </div>
                          </div>
                          <hr class="my-3">
                          <div class="d-flex align-items-center">
                              <i class="bi bi-geo-alt me-3 text-red-600"></i>
                              <div>
                                  <p class="text-sm text-muted mb-0">Location</p>
                                  <p class="mb-0 fw-semibold">{{ $object['event']['location'] }}</p>
                              </div>
                          </div>
                          <hr class="my-3">
                          <div class="d-flex align-items-center">
                              <i class="bi bi-people me-3 text-blue-600"></i>
                              <div>
                                  <p class="text-sm text-muted mb-0">Team Size</p>
                                  @if($object['event']['min_team_size'] == 1 && $object['event']['max_team_size'] == 1)
                                      <p class="mb-0 fw-semibold">1 Member</p>
                                  @else
                                      <p class="mb-0 fw-semibold">
                                          {{ $object['event']['min_team_size'] }}
                                          –
                                          {{ $object['event']['max_team_size'] }} Members
                                      </p>
                                  @endif
                              </div>
                          </div>
                          <hr class="my-3">
                          <div class="d-flex align-items-center">
                              <i class="bi bi-tag me-3 text-green-600"></i>
                              <div>
                                  <p class="text-sm text-muted mb-0">Fee</p>
                                  <p class="mb-0 fw-semibold">BDT {{ $object['event']['registration_fee'] }}</p>
                              </div>
                          </div>
                      </div>
                  </div>

                  <!-- Registration Card -->
                  <div class="bg-white rounded-xl shadow-lg p-6">
                      <h3 class="text-xl font-bold mb-4">
                          <i class="bi bi-rocket-takeoff me-2"></i>Registration
                      </h3>
                      @if(now()->lessThan(\Carbon\Carbon::parse($object['event']['registration_closing_date'])) && !$object['status'])
                          <a
                              href="/fest/{{ $object['fest']['id'] }}/event/{{ $object['event']['id'] }}/register"
                              class="btn btn-dark w-full py-3 rounded-lg fw-semibold mb-3"
                          >
                              <i class="bi bi-pencil-square me-2"></i>Register Now
                          </a>
                      @elseif($object['status'] == 'pending')
                          <div class="alert alert-warning text-center">Registration Pending</div>
                      @elseif($object['status'] == 'approved')
                          <div class="alert alert-success text-center">Registration Approved</div>
                      @elseif($object['status'] == 'rejected')
                          <div class="alert alert-danger text-center">Registration Rejected</div>
                      @else
                          <div class="alert alert-secondary text-center">Registration Closed</div>
                      @endif
                      <div class="text-center mt-4">
                          @if($object['event']['rulebook_link'])
                              <a href="{{ $object['event']['rulebook_link'] }}" class="text-purple-600 hover:text-purple-700 mb-2 block">
                                  <i class="bi bi-file-pdf me-2"></i>Download Rulebook
                              </a>
                          @endif
                          <a href="https://youtu.be/UFjIhtqs254?si=JOI0f0ehT5LGZnyI" class="text-purple-600 hover:text-purple-700 mt-1 block">
                              <i class="bi bi-youtube me-2"></i>Watch How To Register
                          </a>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>

<!-- Gallery Modal -->
<div class="modal fade" id="galleryModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-0">
        <img id="modalImage" src="" alt="Gallery Image" class="w-full" style="max-height: 80vh; object-fit: contain;">
      </div>
    </div>
  </div>
</div>

<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<script>
  document.addEventListener('DOMContentLoaded', function () {
    // Gallery modal functionality
    const galleryModal = document.getElementById('galleryModal');
    if (galleryModal) {
      galleryModal.addEventListener('show.bs.modal', function (event) {
          const trigger = event.relatedTarget;
          const imageSrc = trigger.getAttribute('data-image-src');
          const imageAlt = trigger.getAttribute('data-image-alt');
          
          const modalImage = document.getElementById('modalImage');
          if (modalImage) {
            modalImage.src = imageSrc;
            modalImage.alt = imageAlt;
          }
      });
    }
  });
</script>
@endsection