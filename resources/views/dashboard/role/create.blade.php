@extends('dashboard.templates.body')
@section('title', 'role')

@push('css')

@endpush

@section('content')
<div>
    <form action="{{ route('store.role') }}" method="POST">
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
            Hak Akses
        </div>
        @foreach ($permission as $item)
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" name="permission[]" value="{{ $item['id'] }}" @if(is_array(old('permission')) && in_array($item['id'], old('permission'))) checked @endif>
                <label class="form-check-label" for="exampleCheck1">{{ $item['name'] }}</label>
            </div>
        @endforeach
        @error('permission')
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