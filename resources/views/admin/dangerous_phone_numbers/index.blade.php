@extends('layouts.admin')

@section('title', 'Admin - Dangerous Phone Numbers')

@section('content')
<div class="container py-5">
    <h1 class="mb-4 text-warning fw-bold">Dangerous Phone Numbers</h1>

    <a href="{{ route('admin.dangerous_phone_numbers.create') }}" class="btn btn-warning mb-3">Add New Phone Number</a>

    <form method="GET" action="{{ route('admin.dangerous_phone_numbers.index') }}" class="mb-3">
        <input type="text" name="search" value="{{ $search }}" placeholder="Search phone numbers or keterangan" class="form-control" />
    </form>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($dangerousPhoneNumbers->isEmpty())
        <p>No dangerous phone numbers found.</p>
    @else
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Phone Number</th>
                    <th>Keterangan</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($dangerousPhoneNumbers as $phone)
                <tr>
                    <td>{{ $phone->phone_number }}</td>
                    <td>{{ $phone->keterangan }}</td>
                    <td>
                        <a href="{{ route('admin.dangerous_phone_numbers.edit', $phone->id) }}" class="btn btn-sm btn-warning mb-2"><i class="fas fa-edit" style="color: white;"></i></a>
                        <form action="{{ route('admin.dangerous_phone_numbers.destroy', $phone->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to delete this phone number?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $dangerousPhoneNumbers->links('pagination::bootstrap-5') }}
    @endif
</div>
@endsection
