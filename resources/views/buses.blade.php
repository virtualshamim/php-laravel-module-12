@extends('Layouts.app')
@section('content')
<div class="page-content">
          <div class="container-fluid">
          <table class="table text-center">
            <thead>
                <tr>
                    <th>SL No</th>
                    <th>Bus Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($buses as $key => $bus)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $bus->name }}</td>
                    <td>
                    <button class="btn btn-primary editBtn" data-bs-toggle="modal" data-bs-target="#editModal" data-bus-id="{{ $bus->id }}">Edit</button>
                    <button class="btn btn-danger deleteBtn" data-bus-id="{{ $bus->id }}" data-bs-toggle="modal" data-bs-target="#deleteModal">Delete</button>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
</div>
<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <!-- Edit form -->
    <form action="{{ route('bus-update') }}" method="post">
        @csrf
        <input type="hidden" name="action" value="edit">
        <input type="hidden" name="bus_id" id="editBusId" value="">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Bus Info</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="editBusName">Bus Name:</label>
                        <input type="text" class="form-control" id="editBusName" name="editBusName" placeholder="Enter bus name">
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
            <form id="deleteForm" action="{{ route('bus-delete') }}" method="post">
                @csrf
    <input type="hidden" name="action" value="delete">
    <input type="hidden" id="deleteBusId" name="bus_id">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this bus?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger" id="confirmDeleteBtn">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>
          </div>
          <!-- container-fluid -->
        </div>
        <script>

    // Edit Buss
    const editButtons = document.querySelectorAll('.editBtn');
    const editBusIdInput = document.getElementById('editBusId');
    const editBusNameInput = document.getElementById('editBusName');

    editButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            const busId = btn.getAttribute('data-bus-id');
            editBusIdInput.value = busId;

            // Fetch bus details based on busId and populate the form fields
            fetch(`/get-bus-details/${busId}`)
                .then(response => response.json())
                .then(data => {
                    editBusNameInput.value = data.name;
                })
                .catch(error => console.error('Error:', error));
        });
    });
    //End Edit Bus
    //Delete Bus
    const deleteButtons = document.querySelectorAll('.deleteBtn');
    const deleteBusId = document.getElementById('deleteBusId');
    deleteButtons.forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            const busId = btn.getAttribute('data-bus-id');
            
            // Set the bus ID in the delete form
            deleteBusId.value = busId;

            // Submit the delete form
            deleteBusBtn.click();
        });
    });
</script>
@endsection

