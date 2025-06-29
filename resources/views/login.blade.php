@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">Log In</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="email" name="email" required autofocus>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Log In</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@if ($errors->any())
    <div class="modal fade" id="loginErrorModal" tabindex="-1" aria-labelledby="loginErrorModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header border-0">
            <h5 class="modal-title w-100 text-center" id="loginErrorModalLabel">Login Failed</h5>
          </div>
          <div class="modal-body text-center">
            <img src="https://cdn-icons-png.flaticon.com/512/463/463612.png" alt="Error" style="width:80px;">
            <p class="mt-3 mb-0 text-danger">Credentials are wrong.</p>
          </div>
          <div class="modal-footer border-0 justify-content-center">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">OK</button>
          </div>
        </div>
      </div>
    </div>
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        var modal = new bootstrap.Modal(document.getElementById('loginErrorModal'));
        modal.show();
      });
    </script>
@endif
@endsection
