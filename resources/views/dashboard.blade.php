@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <span>Dashboard</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm">Logout</button>
                    </form>
                </div>
                <div class="card-body">
                    @if($student)
                        <h4>Welcome, {{ $student->first_name }} {{ $student->last_name }}!</h4>
                        <ul class="list-group mt-3">
                            <li class="list-group-item"><strong>Email:</strong> {{ $student->email }}</li>
                            <li class="list-group-item"><strong>Gender:</strong> {{ $student->gender }}</li>
                            <li class="list-group-item"><strong>Date of Birth:</strong> {{ $student->date_of_birth }}</li>
                            <li class="list-group-item"><strong>Phone Number:</strong> {{ $student->phone_number }}</li>
                            <li class="list-group-item"><strong>Address:</strong> {{ $student->address }}</li>
                            <li class="list-group-item"><strong>City:</strong> {{ $student->city }}</li>
                            <li class="list-group-item"><strong>State:</strong> {{ $student->state }}</li>
                            <li class="list-group-item"><strong>Pincode:</strong> {{ $student->pincode }}</li>
                            <li class="list-group-item"><strong>Room Number:</strong> {{ $student->room_number }}</li>
                        </ul>
                    @else
                        <p>You are not logged in.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
