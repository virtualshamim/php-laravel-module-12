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
        <form action="{{ route('new-location') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="locationName">Location Name:</label>
                <input type="text" class="form-control mb-3" id="locationName" name="name" placeholder="Enter location name" value="{{ old('name') }}">
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Add Location</button>
        </form>
    </div>
</div>
@endsection
