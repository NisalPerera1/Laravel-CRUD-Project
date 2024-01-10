<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Item;
use Illuminate\Support\Facades\Storage; 



class ItemController extends Controller
{

    public function index()
    {
        $items = Item::all();
        return view('items.index', compact('items'));
    }

    // Show the form for creating a new item.
    public function create()
    {
        return view('items.create');
    }

    // Store a newly created item in the database.
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validating image format and size
        ]);

        $item = new Item();
        $item->name = $request->input('name');
        $item->description = $request->input('description');

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/images', $imageName);
            $item->image = $imageName;
        }

        $item->save();

        return redirect('/items')->with('success', 'Item created successfully!');
    }

    // Display the specified item.
    public function show($id)
    {
        $item = Item::findOrFail($id);
        return view('items.show', compact('item'));
    }

    // Show the form for editing the specified item.
    public function edit($id)
    {
        $item = Item::findOrFail($id);
        return view('items.edit', compact('item'));
    }

    // Update the specified item in the database.
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validating image format and size
        ]);

        $item = Item::findOrFail($id);
        $item->name = $request->input('name');
        $item->description = $request->input('description');

        // Handle image update
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($item->image) {
                Storage::delete('public/images/' . $item->image);
            }

            // Upload new image
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/images', $imageName);
            $item->image = $imageName;
        }

        $item->save();

        return redirect('/items')->with('success', 'Item updated successfully!');
    }

    // Remove the specified item from the database.
    public function destroy($id)
    {
        $item = Item::findOrFail($id);

        // Delete item image if exists
        if ($item->image) {
            Storage::delete('public/images/' . $item->image);
        }

        $item->delete();

        return redirect('/items')->with('success', 'Item deleted successfully!');
    }


}
