@extends('layouts.app')

@section('content')
<div class="container text-center text-white">
  <h1 class="display-4 fw-bold">Book Your Dream Stay</h1>
  <p class="lead">Luxury & Comfort at the Best Price</p>
  <form class="row g-2 justify-content-center booking-form" id="bookingForm">
    <div class="col-md-3">
      <input type="date" class="form-control" placeholder="Check-in" required>
    </div>
    <div class="col-md-3">
      <input type="date" class="form-control" placeholder="Check-out" required>
    </div>
    <div class="col-md-2">
      <select class="form-select" required>
        <option selected disabled>Guests</option>
        <option>1</option>
        <option>2</option>
        <option>3+</option>
      </select>
    </div>
    <div class="col-md-2">
      <button type="submit" class="btn btn-warning w-100">Search</button>
    </div>
  </form>
</div>

<!-- Featured Rooms -->
<section class="container my-5">
  <h2 class="text-center mb-4">Featured Rooms</h2>
  <div class="row g-4">
    <div class="col-md-4">
      <div class="card shadow-sm">
        <img src="images/image1.jpeg" class="card-img-top" alt="Deluxe Room">
        <div class="card-body">
          <h5 class="card-title">Deluxe Room</h5>
          <p class="card-text">King bed, Free Wi-Fi, City View, Breakfast included</p>
          <a href="#" class="btn btn-primary w-100">Book Now</a>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card shadow-sm">
        <img src="images/image2.jpg" class="card-img-top" alt="Suite">
        <div class="card-body">
          <h5 class="card-title">Suite</h5>
          <p class="card-text">Spacious suite, Living area, Free minibar, Ocean View</p>
          <a href="#" class="btn btn-primary w-100">Book Now</a>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card shadow-sm">
        <img src="images/image3.jpg" class="card-img-top" alt="Family Room">
        <div class="card-body">
          <h5 class="card-title">Family Room</h5>
          <p class="card-text">2 Queen beds, Kids play area, Free breakfast</p>
          <a href="#" class="btn btn-primary w-100">Book Now</a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Facilities -->
<section class="bg-light py-5">
  <div class="container">
    <h2 class="text-center mb-4">Our Facilities</h2>
    <div class="row text-center">
      <div class="col-md-3 mb-3">
        <i class="bi bi-wifi display-5 text-primary"></i>
        <h6>Free Wi-Fi</h6>
      </div>
      <div class="col-md-3 mb-3">
        <i class="bi bi-cup-straw display-5 text-primary"></i>
        <h6>Restaurant & Bar</h6>
      </div>
      <div class="col-md-3 mb-3">
        <i class="bi bi-droplet-half display-5 text-primary"></i>
        <h6>Swimming Pool</h6>
      </div>
      <div class="col-md-3 mb-3">
        <i class="bi bi-car-front display-5 text-primary"></i>
        <h6>Free Parking</h6>
      </div>
    </div>
  </div>
</section>

<!-- Footer -->
<footer class="bg-primary text-white text-center py-3">
  <small>© 2025 HotelBooking. All rights reserved.</small>
</footer>
@endsection
