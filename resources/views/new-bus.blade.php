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
        <form action="{{ route('add-new-bus') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="busName">Bus Name:</label>
                <input type="text" class="form-control mb-3" id="busName" name="name" placeholder="Enter bus name" value="{{ old('name') }}">
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Add Bus</button>
        </form>
    </div>
</div>
@endsection
