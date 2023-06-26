@extends('dashboard.templates.body')
@section('title', 'user')

@push('css')

@endpush

@section('content')
<div>
    <form action="{{ route('store.user') }}" method="POST">
        @csrf
        @method('post')
        <div class="mb-3">
            <label for="name" class="form-label">Nama</label>
            <input type="text" class="form-control" name="name" value="{{ old('name') }}">
        </div>
        @error('name')
            <span class="text-danger">{{ $message }}</span>
        @enderror
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" value="{{ old('email') }}">
        </div>
        @error('email')
            <span class="text-danger">{{ $message }}</span>
        @enderror
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" name="username" value="{{ old('username') }}">
        </div>
        @error('username')
            <span class="text-danger">{{ $message }}</span>
        @enderror
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" name="password">
        </div>
        @error('password')
            <span class="text-danger">{{ $message }}</span>
        @enderror
        <div class="mb-3">
            <label for="confirmPassword" class="form-label">Konfirmasi Password</label>
            <input type="password" class="form-control" name="confirmPassword">
        </div>
        @error('confirmPassword')
            <span class="text-danger">{{ $message }}</span>
        @enderror
        <div class="mb-3">
            Roles
        </div>
        @foreach ($roles as $item)
            <div class="mb-3 form-check">
                <input type="radio" class="form-check-input" name="role" id={{ $item['id'] }} value="{{ $item['id'] }}" @if(old('role') == $item['id']) checked @endif>
                <label class="form-check-label" for={{ $item['id'] }}>{{ $item['name'] }}</label>
            </div>
        @endforeach
        @error('role')
            <span class="text-danger">{{ $message }}</span>
        @enderror
        <div>
            <button type="submit" class="btn btn-primary float-end">Submit</button>
        </div>
    </form>
</div>
@endsection

@push('scripts')

@endpush