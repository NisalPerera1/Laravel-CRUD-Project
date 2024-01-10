
@extends('layouts.app')

@section('content')
    <h1>Edit Item - {{ $item->name }}</h1>
    <form action="{{ route('items.update', $item->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" class="form-control" value="{{ $item->name }}" required>
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea name="description" class="form-control" required>{{ $item->description }}</textarea>
        </div>
        <div class="form-group">
            <label for="image">Image:</label>
            <input type="file" name="image" class="form-control-file">
            @if ($item->image)
                <img src="{{ asset('storage/images/' . $item->image) }}" alt="{{ $item->name }}" style="max-width: 200px; margin-top: 10px;">
            @else
                No Image
            @endif
        </div>
        <div class="form-group">
    <label for="remove_image">Remove Image</label>
    <input type="checkbox" name="remove_image" id="remove_image">
</div>
        <button type="submit" class="btn btn-warning">Update</button>
    </form>
    <a href="{{ route('items.index') }}" class="btn btn-secondary mt-2">Back</a>
@endsection
