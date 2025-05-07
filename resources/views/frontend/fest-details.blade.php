@extends('layouts.main')

@section('main')
<main>
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
</style>

@endsection
