@extends('Layouts.app')
@section('content')
<div class="page-content">
          <div class="container-fluid">
          <table class="table text-center">
            <thead>
                <tr>
                    <th>SL No</th>
                    <th>Location Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($locationes as $key => $location)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $location->name }}</td>
                    <td>
                    <button class="btn btn-primary editBtn" data-bs-toggle="modal" data-bs-target="#editModal" data-location-id="{{ $location->id }}">Edit</button>
                    <button class="btn btn-danger deleteBtn" data-location-id="{{ $location->id }}" data-bs-toggle="modal" data-bs-target="#deleteModal">Delete</button>

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
        <input type="hidden" name="location_id" id="editLocationId" value="">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Location Info</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="editLocationName">Location Name:</label>
                        <input type="text" class="form-control" id="editLocationName" name="editLocationName" placeholder="Enter location name">
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
    <input type="hidden" id="deleteLocationId" name="location_id">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this location?</p>
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

    // Edit Locations
    const editButtons = document.querySelectorAll('.editBtn');
    const editLocationIdInput = document.getElementById('editLocationId');
    const editLocationNameInput = document.getElementById('editLocationName');

    editButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            const locationId = btn.getAttribute('data-location-id');
            editLocationIdInput.value = locationId;

            // Fetch location details based on locationId and populate the form fields
            fetch(`/get-location-details/${locationId}`)
                .then(response => response.json())
                .then(data => {
                    editLocationNameInput.value = data.name;
                })
                .catch(error => console.error('Error:', error));
        });
    });
    //End Edit Location
    //Delete Location
    const deleteButtons = document.querySelectorAll('.deleteBtn');
    const deleteLocationId = document.getElementById('deleteLocationId');
    deleteButtons.forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            const locationId = btn.getAttribute('data-location-id');
            
            // Set the location ID in the delete form
            deleteLocationId.value = locationId;

            // Submit the delete form
            deleteLocationBtn.click();
        });
    });
</script>
@endsection

