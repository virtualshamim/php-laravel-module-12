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
                    <button class="btn btn-success sellBtn" data-bs-toggle="modal" data-bs-target="#sellModal" data-trip-id="{{ $trip->id }}">Book</button>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
</div>
<!-- Sell Modal -->
<div class="modal fade" id="sellModal" tabindex="-1" role="dialog" aria-labelledby="sellModalLabel" aria-hidden="true">
    <form action="{{ route('new-booking') }}" method="post">
        @csrf
        <input type="hidden" name="action" value="sell">
        <input type="hidden" name="trip_id" id="tripId" value="">
        <!-- <input type="hidden" name="trip_name" id="tripName" value="">
        <input type="hidden" name="product_price" id="productPrice" value=""> -->
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="sellModalLabel">Book Trip</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="quantity">Seats:</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" placeholder="Enter quantity" min="1">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Purchase</button>
                </div>
            </div>
        </div>
    </form>
</div>

          </div>
          <!-- container-fluid -->
        </div>
    <script>
            //Sale Product
    const sellButtons = document.querySelectorAll('.sellBtn');
    const productIdInput = document.getElementById('tripId');
    // const productNameInput = document.getElementById('productName');
    // const productPriceInput = document.getElementById('productPrice');

    sellButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            const productId = btn.getAttribute('data-trip-id');
            // const productName = btn.getAttribute('data-product-name');
            // const productPrice = btn.getAttribute('data-product-price');

            // productIdInput.value = productId;
            // productNameInput.value = productName;
            // productPriceInput.value = productPrice;
        });
    });
    </script>
@endsection

