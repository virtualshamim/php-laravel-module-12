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
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tripes as $key => $trip)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $trip->date }}</td>
                    <td>{{ $trip->from }}</td>
                    <td>{{ $trip->to }}</td>
                    <td>{{ $trip->seats }}</td>
                    <td>{{ $trip->fare }}</td>
                    <td>
                    <button class="btn btn-primary editBtn" data-bs-toggle="modal" data-bs-target="#editModal" data-trip-id="{{ $trip->id }}">Edit</button>
                    <button class="btn btn-danger deleteBtn" data-trip-id="{{ $trip->id }}" data-bs-toggle="modal" data-bs-target="#deleteModal">Delete</button>

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
        <input type="hidden" name="trip_id" id="editTripId" value="">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Trip Info</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="editTripName">Date:</label>
                        <input type="date" class="form-control" id="editTripDate" name="editTripDate" placeholder="Select trip date">
                    </div>
                    <div class="form-group">
                        <label for="editTripFrom">From:</label>
                        <select name="fromDropdown" id="fromDropdown">
                        @foreach($locations as $key => $location)
                            <option value="{{ $location->name }}">{{ $location->name }}</option>
                        @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="editTripTo">To:</label>
                        <select name="toDropdown" id="toDropdown">
                        @foreach($locations as $key => $location)
                            <option value="{{ $location->name }}">{{ $location->name }}</option>
                        @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="editTripSeats">Total Seats:</label>
                        <input type="number" class="form-control" id="editTripSeats" name="editTripSeats" placeholder="Set Total Seats">
                    </div>
                    <div class="form-group">
                        <label for="editTripFare">Fare:</label>
                        <input type="number" class="form-control" id="editTripFare" name="editTripFare" placeholder="Set Fare">
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
    <input type="hidden" id="deleteTripId" name="trip_id">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this trip?</p>
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

    // Edit Trips
    const editButtons = document.querySelectorAll('.editBtn');
    const editTripIdInput = document.getElementById('editTripId');
    const editTripDateInput = document.getElementById('editTripDate');
    const editTripFromInput = document.getElementById('editTripFrom');
    const editTripToInput = document.getElementById('editTripTo');
    const editTripSeatsInput = document.getElementById('editTripSeats');
    const editTripFareInput = document.getElementById('editTripFare');

    editButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            const tripId = btn.getAttribute('data-trip-id');
            editTripIdInput.value = tripId;

            // Fetch trip details based on tripId and populate the form fields
            fetch(`/get-trip-details/${tripId}`)
                .then(response => response.json())
                .then(data => {
                    editTripDateInput.value = data.date;
                    editTripFromInput.value = data.from;
                    editTripToInput.value = data.to;
                    editTripSeatsInput.value = data.seats;
                    editTripFareInput.value = data.fare;
                })
                .catch(error => console.error('Error:', error));
        });
    });
    //End Edit Trip
    //Delete Trip
    const deleteButtons = document.querySelectorAll('.deleteBtn');
    const deleteTripId = document.getElementById('deleteTripId');
    deleteButtons.forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            const tripId = btn.getAttribute('data-trip-id');
            
            // Set the trip ID in the delete form
            deleteTripId.value = tripId;

            // Submit the delete form
            deleteTripBtn.click();
        });
    });
</script>
@endsection

