<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactUsCard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ContactUsCardController extends Controller
{
    public function index()
    {
$cards = ContactUsCard::orderBy('order', 'asc')->paginate(10);
return view('admin.contact_us_cards.index', compact('cards'));
    }

    public function create()
    {
        return view('admin.contact_us_cards.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'link' => 'nullable|url',
            'order' => 'nullable|integer|min:0',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('contact_us_images', 'public');
        }

        // Automatically assign order to last if not provided
        $order = $request->order;
        if ($order === null) {
            $maxOrder = ContactUsCard::max('order');
            $order = $maxOrder !== null ? $maxOrder + 1 : 0;
        }

        ContactUsCard::create([
            'title' => $request->title,
            'description' => $request->description,
            'image_path' => $imagePath,
            'link' => $request->link,
            'order' => $order,
        ]);

        return redirect()->route('admin.contact_us_cards.index')->with('success', 'Card created successfully.');
    }

    public function reorder(Request $request)
    {
        $request->validate([
            'order' => 'required|array',
            'order.*' => 'integer|exists:contact_us_cards,id',
        ]);

        foreach ($request->order as $index => $id) {
            ContactUsCard::where('id', $id)->update(['order' => $index]);
        }

        return response()->json(['message' => 'Order updated successfully']);
    }

    public function edit(ContactUsCard $contactUsCard)
    {
        return view('admin.contact_us_cards.edit', compact('contactUsCard'));
    }

    public function update(Request $request, ContactUsCard $contactUsCard)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'link' => 'nullable|url',
            'order' => 'nullable|integer|min:0',
        ]);

        if ($request->hasFile('image')) {
            if ($contactUsCard->image_path) {
                Storage::disk('public')->delete($contactUsCard->image_path);
            }
            $imagePath = $request->file('image')->store('contact_us_images', 'public');
            $contactUsCard->image_path = $imagePath;
        }

        $contactUsCard->title = $request->title;
        $contactUsCard->description = $request->description;
        $contactUsCard->link = $request->link;
        $contactUsCard->order = $request->order ?? 0;
        $contactUsCard->save();

        return redirect()->route('admin.contact_us_cards.index')->with('success', 'Card updated successfully.');
    }

    public function destroy(ContactUsCard $contactUsCard)
    {
        if ($contactUsCard->image_path) {
            Storage::disk('public')->delete($contactUsCard->image_path);
        }
        $contactUsCard->delete();

        return redirect()->route('admin.contact_us_cards.index')->with('success', 'Card deleted successfully.');
    }

    public function moveUp(ContactUsCard $contactUsCard)
    {
        $previousCard = ContactUsCard::where('order', '<', $contactUsCard->order)
            ->orderBy('order', 'desc')
            ->first();

        if ($previousCard) {
            $tempOrder = $contactUsCard->order;
            $contactUsCard->order = $previousCard->order;
            $previousCard->order = $tempOrder;

            $contactUsCard->save();
            $previousCard->save();
        }

        return redirect()->route('admin.contact_us_cards.index')->with('success', 'Card moved up successfully.');
    }

    public function moveDown(ContactUsCard $contactUsCard)
    {
        $nextCard = ContactUsCard::where('order', '>', $contactUsCard->order)
            ->orderBy('order', 'asc')
            ->first();

        if ($nextCard) {
            $tempOrder = $contactUsCard->order;
            $contactUsCard->order = $nextCard->order;
            $nextCard->order = $tempOrder;

            $contactUsCard->save();
            $nextCard->save();
        }

        return redirect()->route('admin.contact_us_cards.index')->with('success', 'Card moved down successfully.');
    }
}
