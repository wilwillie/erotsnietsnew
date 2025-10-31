<?php

namespace App\Http\Controllers;

use App\Models\DangerousPhoneNumber;
use Illuminate\Http\Request;

class DangerousPhoneNumberController extends Controller
{
    public function adminIndex(Request $request)
    {
        $search = $request->query('search', '');

        $query = DangerousPhoneNumber::query();

        if (!empty($search)) {
            $query->where('phone_number', 'like', '%' . $search . '%')
                  ->orWhere('keterangan', 'like', '%' . $search . '%');
        }

    $dangerousPhoneNumbers = $query->orderBy('created_at', 'desc')->paginate(10);

    return view('admin.dangerous_phone_numbers.index', [
        'dangerousPhoneNumbers' => $dangerousPhoneNumbers,
        'search' => $search,
    ]);

    }

    public function userSearch(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'search' => 'nullable|string',
            ]);

            $search = $request->input('search');

            $query = DangerousPhoneNumber::query();

            if (!empty($search)) {
                $query->where('phone_number', 'like', '%' . $search . '%')
                      ->orWhere('keterangan', 'like', '%' . $search . '%');
            }

            $dangerousPhoneNumbers = $query->orderBy('created_at', 'desc')->paginate(10);

            if ($dangerousPhoneNumbers->isEmpty()) {
                return view('dangerous_phone_numbers.search', [
                    'dangerousPhoneNumbers' => null,
                    'search' => $search,
                    'notFound' => true,
                ]);
            }

            return view('dangerous_phone_numbers.search', [
                'dangerousPhoneNumbers' => $dangerousPhoneNumbers,
                'search' => $search,
                'notFound' => false,
            ]);
        }

        // For GET request, show all dangerous phone numbers initially
        $dangerousPhoneNumbers = DangerousPhoneNumber::orderBy('created_at', 'desc')->paginate(10);

        return view('dangerous_phone_numbers.search', [
            'dangerousPhoneNumbers' => $dangerousPhoneNumbers,
            'notFound' => false,
            'search' => '',
        ]);
    }

    public function adminCreate()
    {
        return view('admin.dangerous_phone_numbers.create');
    }

    public function adminStore(Request $request)
    {
        $request->validate([
            'phone_number' => 'required|unique:dangerous_phone_numbers,phone_number',
            'keterangan' => 'nullable|string',
        ]);

        DangerousPhoneNumber::create([
            'phone_number' => $request->phone_number,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('admin.dangerous_phone_numbers.index')->with('success', 'Dangerous phone number added successfully!');
    }

    public function adminEdit($id)
    {
        $dangerousPhoneNumber = DangerousPhoneNumber::findOrFail($id);
        return view('admin.dangerous_phone_numbers.edit', compact('dangerousPhoneNumber'));
    }

    public function adminUpdate(Request $request, $id)
    {
        $dangerousPhoneNumber = DangerousPhoneNumber::findOrFail($id);

        $request->validate([
            'phone_number' => 'required|unique:dangerous_phone_numbers,phone_number,' . $dangerousPhoneNumber->id,
            'keterangan' => 'nullable|string',
        ]);

        $dangerousPhoneNumber->update([
            'phone_number' => $request->phone_number,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('admin.dangerous_phone_numbers.index')->with('success', 'Dangerous phone number updated successfully!');
    }

    public function adminDestroy($id)
    {
        $dangerousPhoneNumber = DangerousPhoneNumber::findOrFail($id);
        $dangerousPhoneNumber->delete();

        return redirect()->route('admin.dangerous_phone_numbers.index')->with('success', 'Dangerous phone number deleted successfully!');
    }
}
