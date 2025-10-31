<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GrupJualBeliCard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GrupJualBeliCardController extends Controller
{
    public function index()
    {
$cards = GrupJualBeliCard::orderBy('order', 'asc')->paginate(10);
return view('admin.grup_jual_beli_cards.index', compact('cards'));
    }

    public function create()
    {
        return view('admin.grup_jual_beli_cards.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'link' => 'nullable|url',
            'order' => 'nullable|integer',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('grup_jual_beli_images', 'public');
        }

        // Automatically assign order to last if not provided
        $order = $request->order;
        if ($order === null) {
            $maxOrder = GrupJualBeliCard::max('order');
            $order = $maxOrder !== null ? $maxOrder + 1 : 0;
        }

        GrupJualBeliCard::create([
            'title' => $request->title,
            'description' => $request->description,
            'image_path' => $imagePath,
            'link' => $request->link,
            'order' => $order,
        ]);

        return redirect()->route('admin.grup_jual_beli_cards.index')->with('success', 'Card created successfully.');
    }

    public function reorder(Request $request)
    {
        $request->validate([
            'order' => 'required|array',
            'order.*' => 'integer|exists:grup_jual_beli_cards,id',
        ]);

        foreach ($request->order as $index => $id) {
            GrupJualBeliCard::where('id', $id)->update(['order' => $index]);
        }

        return response()->json(['message' => 'Order updated successfully']);
    }

    public function edit(GrupJualBeliCard $grupJualBeliCard)
    {
        return view('admin.grup_jual_beli_cards.edit', compact('grupJualBeliCard'));
    }

    public function update(Request $request, GrupJualBeliCard $grupJualBeliCard)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'link' => 'nullable|url',
            'order' => 'nullable|integer',
        ]);

        if ($request->hasFile('image')) {
            if ($grupJualBeliCard->image_path) {
                Storage::disk('public')->delete($grupJualBeliCard->image_path);
            }
            $imagePath = $request->file('image')->store('grup_jual_beli_images', 'public');
            $grupJualBeliCard->image_path = $imagePath;
        }

        $grupJualBeliCard->title = $request->title;
        $grupJualBeliCard->description = $request->description;
        $grupJualBeliCard->link = $request->link;
        $grupJualBeliCard->order = $request->order ?? 0;
        $grupJualBeliCard->save();

        return redirect()->route('admin.grup_jual_beli_cards.index')->with('success', 'Card updated successfully.');
    }

    public function destroy(GrupJualBeliCard $grupJualBeliCard)
    {
        if ($grupJualBeliCard->image_path) {
            Storage::disk('public')->delete($grupJualBeliCard->image_path);
        }
        $grupJualBeliCard->delete();

        return redirect()->route('admin.grup_jual_beli_cards.index')->with('success', 'Card deleted successfully.');
    }

    public function moveUp(GrupJualBeliCard $grupJualBeliCard)
    {
        $previousCard = GrupJualBeliCard::where('order', '<', $grupJualBeliCard->order)
            ->orderBy('order', 'desc')
            ->first();

        if ($previousCard) {
            $tempOrder = $grupJualBeliCard->order;
            $grupJualBeliCard->order = $previousCard->order;
            $previousCard->order = $tempOrder;

            $grupJualBeliCard->save();
            $previousCard->save();
        }

        return redirect()->route('admin.grup_jual_beli_cards.index')->with('success', 'Card moved up successfully.');
    }

    public function moveDown(GrupJualBeliCard $grupJualBeliCard)
    {
        $nextCard = GrupJualBeliCard::where('order', '>', $grupJualBeliCard->order)
            ->orderBy('order', 'asc')
            ->first();

        if ($nextCard) {
            $tempOrder = $grupJualBeliCard->order;
            $grupJualBeliCard->order = $nextCard->order;
            $nextCard->order = $tempOrder;

            $grupJualBeliCard->save();
            $nextCard->save();
        }

        return redirect()->route('admin.grup_jual_beli_cards.index')->with('success', 'Card moved down successfully.');
    }
}
