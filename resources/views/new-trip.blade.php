@extends('Layouts.app')
@section('content')
<div class="page-content">
    <div class="container-fluid">
    @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <form action="{{ route('new-trip') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="tripName">Trip Date:</label>
                <input type="date" class="form-control mb-3" id="tripDate" name="date" placeholder="Enter trip date" value="{{ old('date') }}">
                @error('date')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <select name="fromDropdown" id="fromDropdown">
                        @foreach($locations as $key => $location)
                            <option value="{{ $location->name }}">{{ $location->name }}</option>
                        @endforeach
                </select>
            </div>
            <div class="form-group">
                <select name="toDropdown" id="toDropdown">
                        @foreach($locations as $key => $location)
                            <option value="{{ $location->name }}">{{ $location->name }}</option>
                        @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="tripSeats">Total Seats</label>
                <input type="number" class="form-control mb-3" id="tripSeats" name="seats" placeholder="Enter trip seats" value="{{ old('seats') }}">
                @error('seats')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="tripSeats">Fare:</label>
                <input type="number" class="form-control mb-3" id="tripFare" name="fare" placeholder="Enter trip fare" value="{{ old('fare') }}">
                @error('fare')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Add Trip</button>
        </form>
    </div>
</div>
@endsection
