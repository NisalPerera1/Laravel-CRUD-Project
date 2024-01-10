
@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="card" style="width: 18rem;">
            @if ($item->image)
                <img src="{{ asset('storage/images/' . $item->image) }}" class="card-img-top" alt="{{ $item->name }}">
            @else
                <p class="card-text">No Image</p>
            @endif
            <div class="card-body">
                <h5 class="card-title">{{ $item->name }}</h5>
                <p class="card-text">{{ $item->description }}</p>
                <a href="{{ route('items.index') }}" class="btn btn-secondary">Back</a>
            </div>
        </div>
    </div>
@endsection
