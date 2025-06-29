@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <span>Admin Dashboard</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm">Logout</button>
                    </form>
                </div>
                <div class="card-body">
                    <h4>Registered Users</h4>
                    <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addHostelStudentModal">Add Student in Hostel</button>
                    <table class="table table-bordered table-striped mt-3">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Gender</th>
                                <th>Date of Birth</th>
                                <th>City</th>
                                <th>State</th>
                                <th>Is Admin</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $user->first_name }}</td>
                                    <td>{{ $user->last_name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->gender }}</td>
                                    <td>{{ $user->date_of_birth }}</td>
                                    <td>{{ $user->city }}</td>
                                    <td>{{ $user->state }}</td>
                                    <td>{{ $user->is_admin ? 'Yes' : 'No' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Add Hostel Student Modal -->
                    <div class="modal fade" id="addHostelStudentModal" tabindex="-1" aria-labelledby="addHostelStudentModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="addHostelStudentModalLabel">Add Student in Hostel</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <form method="POST" action="{{ route('hostel-students.store') }}">
                            @csrf
                            <div class="modal-body">
                              <div class="mb-3">
                                <label for="student_id" class="form-label">Student Name</label>
                                <select class="form-select" id="student_id" name="student_id" required>
                                  <option value="" disabled selected>Select Student</option>
                                  @foreach(App\Models\StudentRegistration::all() as $student)
                                    <option value="{{ $student->student_id }}">{{ $student->first_name }} {{ $student->last_name }}</option>
                                  @endforeach
                                </select>
                              </div>
                              <div class="mb-3">
                                <label for="room_number" class="form-label">Room Number</label>
                                <input type="text" class="form-control" id="room_number" name="room_number">
                              </div>
                              <div class="mb-3">
                                <label for="admission_in_date" class="form-label">Admission In Date</label>
                                <input type="date" class="form-control" id="admission_in_date" name="admission_in_date" required>
                              </div>
                              <div class="mb-3">
                                <label for="bed_number" class="form-label">Bed Number</label>
                                <input type="text" class="form-control" id="bed_number" name="bed_number">
                              </div>
                              <div class="mb-3">
                                <label for="deposit_amount" class="form-label">Deposit Amount</label>
                                <input type="number" step="0.01" class="form-control" id="deposit_amount" name="deposit_amount">
                              </div>
                              <div class="mb-3">
                                <label for="rent_amount" class="form-label">Rent Amount</label>
                                <input type="number" step="0.01" class="form-control" id="rent_amount" name="rent_amount">
                              </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                              <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>

                    @if(session('status'))
                        <div class="modal fade" id="hostelStudentSuccessModal" tabindex="-1" aria-labelledby="hostelStudentSuccessModalLabel" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                              <div class="modal-header border-0">
                                <h5 class="modal-title w-100 text-center" id="hostelStudentSuccessModalLabel">Success</h5>
                              </div>
                              <div class="modal-body text-center">
                                <img src="https://cdn-icons-png.flaticon.com/512/190/190411.png" alt="Success" style="width:80px;">
                                <p class="mt-3 mb-0">Data saved successfully!</p>
                              </div>
                              <div class="modal-footer border-0 justify-content-center">
                                <button type="button" class="btn btn-success" data-bs-dismiss="modal">OK</button>
                              </div>
                            </div>
                          </div>
                        </div>
                        <script>
                          document.addEventListener('DOMContentLoaded', function() {
                            var modal = new bootstrap.Modal(document.getElementById('hostelStudentSuccessModal'));
                            modal.show();
                          });
                        </script>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
