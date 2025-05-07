@extends('layouts.main')
@section('main')

<div class="container py-5">
    <!-- Header -->
    <div class="profile-header d-flex align-items-center">
      <div class="me-4">
        <img src="https://avatar.iran.liara.run/public/{{$user->userInfo->gender}}?username={{ explode('@', $user->email)[0] }}" alt="Avatar" class="avatar-img">
      </div>
      <div>
        <h2 class="mb-1">{{$user->name}}</h2>
        <p class="mb-1"><strong>{{$user->student_id}}</strong></p>
        <p class="mb-0">{{$user->university}}</p>
      </div>
    </div>
  
    <!-- Bio and Contact Info -->
    <div class="row mt-4">
      <div class="col-lg-12 mb-3">
        <div class="card p-4 info-card">
          <h5>Bio</h5>
          <p>{{$user->userInfo->bio}}</p>
        </div>
      </div>
    </div>
  
    <!-- Additional Info -->
    <div class="row">
      <div class="col-lg-4 mb-3">
        <div class="card p-4 info-card">
          <h6 class="text-muted">Gender</h6>
          <p class="mb-0">Boy</p>
        </div>
      </div>
      <div class="col-lg-4 mb-3">
        <div class="card p-4 info-card">
          <h6 class="text-muted">University</h6>
          <p class="mb-0">
            @if($user->university)
                {{$user->university}}
            @else
                Not Set
            @endif
          </p>
        </div>
      </div>
      <div class="col-lg-4 mb-3">
        <div class="card p-4 info-card">
          <h6 class="text-muted">Batch</h6>
          <p class="mb-0">Not Set</p>
        </div>
      </div>
    </div>
  
    <!-- Events and Teams -->
    <h4 class="section-title">Participated Events</h4>
    <div class="card p-3 mb-4 info-card">
      <p class="text-muted mb-0">No events participated yet.</p>
    </div>
  
    <h4 class="section-title">Teams</h4>
    <div class="card p-3 info-card">
      <p class="text-muted mb-0">No teams joined yet.</p>
    </div>
  
  </div>
  


  <style>
    body {
      background-color: #f4f6f9;
    }
    .profile-header {
      background: linear-gradient(to right, #4e54c8, #8f94fb);
      color: white;
      border-radius: 15px;
      padding: 2rem;
      box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    }
    .avatar-img {
      width: 150px;
      height: 150px;
      border-radius: 50%;
      object-fit: cover;
      border: 4px solid #fff;
      box-shadow: 0 0 10px rgba(0,0,0,0.2);
    }
    .info-card {
      border-radius: 15px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    }
    .section-title {
      font-weight: 600;
      margin-top: 30px;
      margin-bottom: 15px;
    }
    .social-icons a {
      margin-right: 15px;
      font-size: 1.3rem;
      color: #555;
    }
    .social-icons a:hover {
      color: #4e54c8;
    }
  </style>

@endsection