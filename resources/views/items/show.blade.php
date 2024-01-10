
@extends('layouts.app')

@section('content')
    <h1>{{ $item->name }}</h1>
    <p>Description: {{ $item->description }}</p>
    <p>Image:
        @if ($item->image)
            <img src="{{ asset('storage/images/' . $item->image) }}" alt="{{ $item->name }}" style="max-width: 300px;">
        @else
            No Image
        @endif
    </p>
    <a href="{{ route('items.index') }}" class="btn btn-secondary">Back</a>
@endsection
