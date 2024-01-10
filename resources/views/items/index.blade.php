
@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1>Here are your Items</h1>
        <div class="d-flex justify-content-end mb-3">
            <a href="{{ route('items.create') }}" class="btn btn-success"><i class="fas fa-plus"></i> Create Item</a>
        </div>
        @if (count($items) > 0)
            <table class="table table-bordered mt-3">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->description }}</td>

                            <td>
                                @if ($item->image)
                                    <img src="{{ asset('storage/images/' . $item->image) }}" alt="{{ $item->name }}" style="max-width: 100px;">
                                @else
                                    No Image
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('items.show', $item->id) }}" class="btn btn-info"><i class="fas fa-eye"></i> View</a>
                                <a href="{{ route('items.edit', $item->id) }}" class="btn btn-warning"><i class="fas fa-edit"></i> Edit</a>
                                <form action="{{ route('items.destroy', $item->id) }}" method="post" style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')"><i class="fas fa-trash-alt"></i> Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No items found.</p>
        @endif
    </div>
@endsection
