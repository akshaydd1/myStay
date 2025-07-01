@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <span>Admin Dashboard</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm">Logout</button>
                    </form>
                </div>
                <div class="card-body">
                    <!-- Dashboard Summary Cards -->
                    <div class="row mb-4">
                        <div class="col-md-4 mb-3">
                            <div class="card text-center shadow-sm h-100">
                                <div class="card-body">
                                    <h6 class="card-title text-muted">Registered Users</h6>
                                    <h2 class="fw-bold">{{ $users->count() }}</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="card text-center shadow-sm h-100">
                                <div class="card-body">
                                    <h6 class="card-title text-muted">Hostel Students</h6>
                                    <h2 class="fw-bold">{{ $hostelStudents->count() }}</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="card text-center shadow-sm h-100">
                                <div class="card-body">
                                    <h6 class="card-title text-muted">Profit This Month</h6>
                                    <h2 class="fw-bold">
                                        ₹{{
                                            $hostelStudents->where('admission_in_date', '>=', now()->startOfMonth()->toDateString())
                                                ->sum('rent_amount')
                                        }}
                                    </h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Subnavbar -->
                    <ul class="nav nav-tabs mb-4" id="adminTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="users-tab" data-bs-toggle="tab" data-bs-target="#users" type="button" role="tab" aria-controls="users" aria-selected="true">Registered Users</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="hostel-tab" data-bs-toggle="tab" data-bs-target="#hostel" type="button" role="tab" aria-controls="hostel" aria-selected="false">Hostel Students</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="payments-tab" data-bs-toggle="tab" data-bs-target="#payments" type="button" role="tab" aria-controls="payments" aria-selected="false">Student Payment List</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="expenses-tab" data-bs-toggle="tab" data-bs-target="#expenses" type="button" role="tab" aria-controls="expenses" aria-selected="false">Expense List</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="adminTabContent">
                        <!-- Registered Users Tab -->
                        <div class="tab-pane fade show active" id="users" role="tabpanel" aria-labelledby="users-tab">
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
                        </div>
                        <!-- Hostel Students Tab -->
                        <div class="tab-pane fade" id="hostel" role="tabpanel" aria-labelledby="hostel-tab">
                            <h4>Hostel Students</h4>
                            <table class="table table-bordered table-striped mt-3">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Student Name</th>
                                        <th>Room Number</th>
                                        <th>Admission In</th>
                                        <th>Admission Out</th>
                                        <th>Bed Number</th>
                                        <th>Deposit</th>
                                        <th>Rent</th>
                                        <th>Created At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($hostelStudents as $hostel)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ optional($hostel->student)->first_name }} {{ optional($hostel->student)->last_name }}</td>
                                            <td>{{ $hostel->room_number }}</td>
                                            <td>{{ $hostel->admission_in_date }}</td>
                                            <td>{{ $hostel->admission_out_date }}</td>
                                            <td>{{ $hostel->bed_number }}</td>
                                            <td>{{ $hostel->deposit_amount }}</td>
                                            <td>{{ $hostel->rent_amount }}</td>
                                            <td>{{ $hostel->created_at }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- Student Payment List Tab -->
                        <div class="tab-pane fade" id="payments" role="tabpanel" aria-labelledby="payments-tab">
                            <h4>Student Payment List</h4>
                            <table class="table table-bordered table-striped mt-3">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Actual Rent</th>
                                        <th>Paid Rent</th>
                                        <th>Remaining Rent</th>
                                        <th>Payment Status</th>
                                        <th>Payment</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($hostelStudents as $hostel)
                                        @php
                                            $actualRent = $hostel->rent_amount ?? 0;
                                            $paidRent = optional($hostel->rentPayments)->sum('rent_amount');
                                            $remainingRent = $actualRent - $paidRent;
                                            $status = $remainingRent <= 0 ? 'Paid' : ($paidRent > 0 ? 'Partial' : 'Unpaid');
                                        @endphp
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ optional($hostel->student)->first_name }} {{ optional($hostel->student)->last_name }}</td>
                                            <td>₹{{ $actualRent }}</td>
                                            <td>₹{{ $paidRent }}</td>
                                            <td>₹{{ $remainingRent }}</td>
                                            <td>
                                                <span class="badge {{ $status == 'Paid' ? 'bg-success' : ($status == 'Partial' ? 'bg-warning text-dark' : 'bg-danger') }}">{{ $status }}</span>
                                            </td>
                                            <td>
                                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#paymentModal{{ $hostel->id }}">Payment</button>
                                                <!-- Payment Modal -->
                                                <div class="modal fade" id="paymentModal{{ $hostel->id }}" tabindex="-1" aria-labelledby="paymentModalLabel{{ $hostel->id }}" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="paymentModalLabel{{ $hostel->id }}">Pay Rent for {{ optional($hostel->student)->first_name }} {{ optional($hostel->student)->last_name }}</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <form method="POST" action="{{ route('hostel-rent-payments.store') }}">
                                                                @csrf
                                                                <input type="hidden" name="student_id" value="{{ $hostel->student_id }}">
                                                                <input type="hidden" name="hostel_student_id" value="{{ $hostel->id }}">
                                                                <div class="modal-body">
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Name</label>
                                                                        <input type="text" class="form-control" value="{{ optional($hostel->student)->first_name }} {{ optional($hostel->student)->last_name }}" readonly>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Amount to Pay</label>
                                                                        <input type="number" class="form-control" name="amount" max="{{ $remainingRent }}" min="1" value="{{ $remainingRent > 0 ? $remainingRent : 0 }}" required>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary">Submit Payment</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- Expense List Tab -->
                        <div class="tab-pane fade" id="expenses" role="tabpanel" aria-labelledby="expenses-tab">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4>Expense List</h4>
                                <div>
                                    <button class="btn btn-info me-2" data-bs-toggle="modal" data-bs-target="#addCategoryModal">Add Category</button>
                                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addExpenseModal">Add Expense</button>
                                </div>
                            </div>
                            <table class="table table-bordered table-striped mt-3">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Expense Date</th>
                                        <th>Amount</th>
                                        <th>Category Name</th>
                                        <th>Receipt</th>
                                        <th>Note</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($expenses as $expense)
                                        <tr>
                                            <td>{{ $expense->expense_id }}</td>
                                            <td>{{ $expense->expense_date }}</td>
                                            <td>₹{{ $expense->amount }}</td>
                                            <td>{{ optional($expense->category)->category_name }}</td>
                                            <td>
                                                @if($expense->receipt)
                                                    <a href="{{ asset('storage/' . $expense->receipt) }}" target="_blank" class="btn btn-info btn-sm">View</a>
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>{{ $expense->note }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

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

                    <!-- Add Expense Modal -->
                    <div class="modal fade" id="addExpenseModal" tabindex="-1" aria-labelledby="addExpenseModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addExpenseModalLabel">Add Expense</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form method="POST" action="{{ route('expenses.store') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="expense_date" class="form-label">Expense Date</label>
                                            <input type="date" class="form-control" id="expense_date" name="expense_date" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="amount" class="form-label">Amount</label>
                                            <input type="number" step="0.01" class="form-control" id="amount" name="amount" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="category_id" class="form-label">Category Name</label>
                                            <select class="form-select" id="category_id" name="category_id" required>
                                                <option value="" disabled selected>Select Category</option>
                                                @foreach(App\Models\ExpenseCategory::all() as $cat)
                                                    <option value="{{ $cat->id }}">{{ $cat->category_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="receipt" class="form-label">Receipt</label>
                                            <input type="file" class="form-control" id="receipt" name="receipt" accept="image/*,application/pdf">
                                        </div>
                                        <div class="mb-3">
                                            <label for="note" class="form-label">Note</label>
                                            <textarea class="form-control" id="note" name="note"></textarea>
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

                    <!-- Add Category Modal -->
                    <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addCategoryModalLabel">Add Expense Category</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form method="POST" action="{{ route('expense-categories.store') }}">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="category_name" class="form-label">Category Name</label>
                                            <input type="text" class="form-control" id="category_name" name="category_name" required maxlength="100">
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
