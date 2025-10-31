@extends('layouts.admin')

@section('title', 'Admin - Grup Jual Beli Cards')

@section('content')
<div class="container py-5">
    <h1 class="mb-4 text-warning fw-bold">Grup Jual Beli Cards</h1>

    <a href="{{ route('admin.grup_jual_beli_cards.create') }}" class="btn btn-warning mb-3">Add New Card</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($cards->count())
    <table class="table table-bordered" id="sortable-table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Image</th>
                <th>Link</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="sortable-tbody">
            @foreach($cards as $card)
            <tr data-id="{{ $card->id }}">
                <td>{{ $card->title }}</td>
                <td>{{ Str::limit($card->description, 50) }}</td>
                <td>
                    @if($card->image_path)
                        <img src="{{ asset('storage/' . $card->image_path) }}" alt="{{ $card->title }}" style="width: 100px; height: auto;">
                    @else
                        No Image
                    @endif
                </td>
                <td><a href="{{ $card->link }}" target="_blank">{{ $card->link }}</a></td>
                <td>
                    <a href="{{ route('admin.grup_jual_beli_cards.edit', $card) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit" style="color: white;"></i></a>
                    <form action="{{ route('admin.grup_jual_beli_cards.destroy', $card) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to delete this card?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                    </form>
                    <a href="{{ route('admin.grup_jual_beli_cards.moveUp', $card) }}" class="btn btn-sm btn-secondary" title="Move Up"><i class="fas fa-arrow-up"></i></a>
                    <a href="{{ route('admin.grup_jual_beli_cards.moveDown', $card) }}" class="btn btn-sm btn-secondary" title="Move Down"><i class="fas fa-arrow-down"></i></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $cards->links('pagination::bootstrap-5') }}
    @else
        <p>No cards found.</p>
    @endif
</div>
@endsection

@include('admin.grup_jual_beli_cards.index-scripts')
