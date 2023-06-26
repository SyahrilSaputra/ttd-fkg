@extends('dashboard.templates.body')
@section('title', 'role')

@push('css')

@endpush

@section('content')
<div>
    <form action="{{ route('update.role', $role['id']) }}" method="POST">
        @csrf
        @method('post')
        <div class="mb-3">
            <label for="name" class="form-label">Nama</label>
            <input type="text" class="form-control" value="{{ old('name') ? old('name') : $role['name'] }}" name="name">
        </div>
        @error('name')
            <span class="text-danger">{{ $message }}</span>
        @enderror
        <div class="mb-3">
            Hak Akses
        </div>
        @foreach ($permission as $item)
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" name="permission[]" 
                    @if (!old('permission'))
                        {{ in_array($item['id'], $rolePermissions) ? 'checked' : '' }} 
                    @else
                        {{ is_array(old('permission')) && in_array($item['id'], old('permission')) ? 'checked' : '' }} 
                    @endif
                    
                    value="{{ $item['id'] }}">
                <label class="form-check-label" for="exampleCheck1">{{ $item['name'] }}</label>
            </div>
        @endforeach
        @error('permission')
            <span class="text-danger">{{ $message }}</span>
        @enderror
        <div>
            <button type="submit" class="btn btn-primary float-end">Update</button>
        </div>
    </form>
</div>
@endsection

@push('scripts')

@endpush