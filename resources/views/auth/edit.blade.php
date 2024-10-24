<!-- resources/views/edit.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Profile</h1>

    <!-- Display Success Message -->
    @if(session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <!-- Display Validation Errors -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Profile Update Form -->
    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <!-- Name Field -->
        <div class="form-group">
            <label for="name">Name</label>
            <input 
                type="text" 
                name="name" 
                id="name" 
                class="form-control @error('name') is-invalid @enderror" 
                value="{{ old('name', auth()->user()->name) }}" 
                required 
                autofocus
            >
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <!-- Email Field (Optional) -->
        <!--
        <div class="form-group">
            <label for="email">Email</label>
            <input 
                type="email" 
                name="email" 
                id="email" 
                class="form-control @error('email') is-invalid @enderror" 
                value="{{ old('email', auth()->user()->email) }}" 
                required
            >
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        -->

        <!-- Sensitive Data Field -->
        {{-- <div class="form-group">
            <label for="sensitive_data">Sensitive Data</label>
            <input 
                type="text" 
                name="sensitive_data" 
                id="sensitive_data" 
                class="form-control @error('sensitive_data') is-invalid @enderror" 
                value="{{ old('sensitive_data', auth()->user()->sensitive_data) }}" 
                required
            >
            @error('sensitive_data')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div> --}}

        <!-- Additional Fields (e.g., Profile Photo) -->
        <div class="form-group" style="margin-top: 20px">
            <label for="profile_photo">Profile Photo</label>
            <input 
                type="file" 
                name="profile_photo" 
                id="profile_photo" 
                class="form-control-file @error('profile_photo') is-invalid @enderror"
            >
            @error('profile_photo')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary mt-3">
            Update Profile
        </button>
    </form>
</div>
@endsection
