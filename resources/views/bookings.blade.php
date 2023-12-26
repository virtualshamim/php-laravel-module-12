@extends('Layouts.app')
@section('content')
<div class="page-content">
          <div class="container-fluid">
          <table class="table text-center">
            <thead>
                <tr>
                    <th>SL No</th>
                    <th>Date</th>
                    <th>From</th>
                    <th>To</th>
                    <th>Seats</th>
                    <th>Fare</th>
                    <th>Total Fare</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bookinges as $key => $booking)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $booking->date }}</td>
                    <td>{{ $booking->from }}</td>
                    <td>{{ $booking->to }}</td>
                    <td>{{ $booking->seats }}</td>
                    <td>{{ $booking->fare }}</td>
                    <td>{{ $booking->totalfare }}</td>
                    <td>
                    <button class="btn btn-primary editBtn" data-bs-toggle="modal" data-bs-target="#editModal" data-booking-id="{{ $booking->id }}">Edit</button>
                    <button class="btn btn-danger deleteBtn" data-booking-id="{{ $booking->id }}" data-bs-toggle="modal" data-bs-target="#deleteModal">Delete</button>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
</div>
<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <!-- Edit form -->
    <form action="{{ route('edit-action') }}" method="post">
        @csrf
        <input type="hidden" name="action" value="edit">
        <input type="hidden" name="booking_id" id="editBookingId" value="">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Booking Info</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="editBookingName">Date:</label>
                        <input type="date" class="form-control" id="editBookingDate" name="editBookingDate" placeholder="Select booking date">
                    </div>
                    <div class="form-group">
                        <label for="editBookingFrom">From:</label>
                        <select name="fromDropdown" id="fromDropdown">
                        @foreach($locations as $key => $location)
                            <option value="{{ $location->name }}">{{ $location->name }}</option>
                        @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="editBookingTo">To:</label>
                        <select name="toDropdown" id="toDropdown">
                        @foreach($locations as $key => $location)
                            <option value="{{ $location->name }}">{{ $location->name }}</option>
                        @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="editBookingSeats">Seats:</label>
                        <input type="number" class="form-control" id="editBookingSeats" name="editBookingSeats" placeholder="Set Total Seats">
                    </div>
                    <div class="form-group">
                        <label for="editBookingFare">Fare:</label>
                        <input type="number" class="form-control" id="editBookingFare" name="editBookingFare" placeholder="Set Fare">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="deleteForm" action="{{ route('delete-action') }}" method="post">
                @csrf
    <input type="hidden" name="action" value="delete">
    <input type="hidden" id="deleteBookingId" name="booking_id">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this booking?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger" id="confirmDeleteBtn">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>
          </div>product
          <!-- container-fluid -->
        </div>
        <script>

    // Edit Bookings
    const editButtons = document.querySelectorAll('.editBtn');
    const editBookingIdInput = document.getElementById('editBookingId');
    const editBookingDateInput = document.getElementById('editBookingDate');
    const editBookingFromInput = document.getElementById('editBookingFrom');
    const editBookingToInput = document.getElementById('editBookingTo');
    const editBookingSeatsInput = document.getElementById('editBookingSeats');
    const editBookingFareInput = document.getElementById('editBookingFare');

    editButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            const bookingId = btn.getAttribute('data-booking-id');
            editBookingIdInput.value = bookingId;

            // Fetch booking details based on bookingId and populate the form fields
            fetch(`/get-booking-details/${bookingId}`)
                .then(response => response.json())
                .then(data => {
                    editBookingDateInput.value = data.date;
                    editBookingFromInput.value = data.from;
                    editBookingToInput.value = data.to;
                    editBookingSeatsInput.value = data.seats;
                    editBookingFareInput.value = data.fare;
                })
                .catch(error => console.error('Error:', error));
        });
    });
    //End Edit Booking
    //Delete Booking
    const deleteButtons = document.querySelectorAll('.deleteBtn');
    const deleteBookingId = document.getElementById('deleteBookingId');
    deleteButtons.forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            const bookingId = btn.getAttribute('data-booking-id');
            
            // Set the booking ID in the delete form
            deleteBookingId.value = bookingId;

            // Submit the delete form
            deleteBookingBtn.click();
        });
    });
</script>
@endsection

