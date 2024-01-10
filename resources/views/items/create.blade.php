
@extends('layouts.app')

@section('content')
    <h1>Create Item</h1>
    <form action="{{ route('items.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea name="description" class="form-control" required></textarea>
        </div>
        <div class="form-group">
            <label for="image">Image:</label>
            <input type="file" name="image" class="form-control-file">
        </div>
        <button type="submit" class="btn btn-success">Create</button>
    </form>
    <a href="{{ route('items.index') }}" class="btn btn-secondary mt-2">Back</a>
@endsection
