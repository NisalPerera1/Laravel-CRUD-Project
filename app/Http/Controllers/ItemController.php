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

    public function create()
    {
        return view('items.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', 
        ]);

        $item = new Item();
        $item->name = $request->input('name');
        $item->description = $request->input('description');

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/images', $imageName);
            $item->image = $imageName;
        }

        $item->save();

        return redirect('/items')->with('success', 'Item created successfully!');
    }

    public function show($id)
    {
        $item = Item::findOrFail($id);
        return view('items.show', compact('item'));
    }

    public function edit($id)
    {
        $item = Item::findOrFail($id);
        return view('items.edit', compact('item'));
    }

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

        // Handle image update or removal
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
        } elseif ($request->input('remove_image')) {
            // Remove assigned image
            if ($item->image) {
                Storage::delete('public/images/' . $item->image);
                $item->image = null;
            }
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
