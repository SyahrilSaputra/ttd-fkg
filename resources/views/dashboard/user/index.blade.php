@extends('dashboard.templates.body')
@section('title', 'user')

@push('css')

@endpush

@section('content')
<div>
    <div class="mb-3">
        <a href="{{ route('create.user') }}" class="btn btn-primary float-end">Tambah</a>
    </div>
    @if (session('status'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <span>{{ session('status') }}</span>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nama</th>
                <th scope="col">Email</th>
                <th scope="col">Tanggal dibuat</th>
                <th scope="col">Tanggal diupdate</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $item)
            <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>{{ $item['name'] }}</td>
                <td>{{ $item['email'] }}</td>
                <td>{{ $item['created_at'] }}</td>
                <td>{{ $item['updated_at'] }}</td>
                <td nowrap="nowrap">
                    <a href="{{ route('edit.user', $item['id']) }}" class="badge bg-warning border-0">Edit</a>
                    <a onclick="return confirm('Apakah anda yakin ?')" href="{{ route('delete.user', $item['id']) }}" class="badge bg-danger border-0">Delete</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@push('scripts')

@endpush