<?php

namespace App\Http\Controllers;

use App\Models\DangerousAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class DangerousAccountController extends Controller
{
    public function create()
    {
        return view('report');
    }

    public function store(Request $request)
    {
$request->validate([
            'ml_id' => 'required|unique:dangerous_accounts,ml_id',
            'tanggal_kejadian' => 'nullable|date|before_or_equal:today',
            'bukti_kasus' => 'nullable|array',
            'bukti_kasus.*' => 'file|mimes:jpg,jpeg,png|max:4096',
        ]);

        try {
            $buktiPaths = [];
            if ($request->hasFile('bukti_kasus')) {
                foreach ($request->file('bukti_kasus') as $file) {
                    $buktiPaths[] = $file->store('bukti', 'public');
                }
                Log::info('Files stored at: ' . implode(', ', $buktiPaths));
            } else {
                Log::info('No files uploaded.');
            }

            DangerousAccount::create([
                'ml_id' => $request->ml_id,
                'server_id' => $request->server_id,
                'pelaku_nickname' => $request->pelaku_nickname,
                'korban_nickname' => $request->korban_nickname,
                'tanggal_kejadian' => $request->tanggal_kejadian,
                'bukti_file_path' => json_encode($buktiPaths),
                'kronologi' => $request->kronologi,
                'is_accepted' => false,
            ]);
        } catch (\Exception $e) {
            Log::error('Error uploading files: ' . $e->getMessage());
            return redirect()->back()->withErrors(['upload_error' => 'Error uploading files: ' . $e->getMessage()])->withInput();
        }

        return redirect()->back()->with('success', 'Laporan berhasil dikirim!');
    }

    public function cekIdForm()
    {
        return view('cek_id');
    }

    public function cekIdSubmit(Request $request)
    {
        $request->validate([
            'id' => 'required|string',
        ]);

        $inputId = $request->input('id');
        $dangerousAccount = DangerousAccount::where('ml_id', $inputId)->first();

        return view('cek_id', [
            'inputId' => $inputId,
            'dangerousAccount' => $dangerousAccount,
        ]);
    }

    public function index(Request $request)
    {
        $sortableFields = [
            'ml_id',
            'server_id',
            'pelaku_nickname',
            'korban_nickname',
            'tanggal_kejadian',
        ];

        $sortBy = $request->query('sort_by');
        $sortOrder = $request->query('sort_order', 'desc'); // default to desc for latest first
        $search = $request->query('search', '');

        if (!in_array($sortBy, $sortableFields)) {
            $sortBy = 'tanggal_kejadian';
        }

        if (!in_array(strtolower($sortOrder), ['asc', 'desc'])) {
            $sortOrder = 'desc';
        }

        $query = DangerousAccount::query();

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('ml_id', 'like', '%' . $search . '%')
                    ->orWhere('pelaku_nickname', 'like', '%' . $search . '%')
                    ->orWhere('korban_nickname', 'like', '%' . $search . '%');
            });
        }

        // Filter only accepted reports
        $query->where('is_accepted', true);

        $dangerousAccounts = $query->orderBy($sortBy, $sortOrder)->get();

        return view('kasus', [
            'dangerousAccounts' => $dangerousAccounts,
            'sortBy' => $sortBy,
            'sortOrder' => $sortOrder,
            'search' => $search,
        ]);
    }

    // Admin methods

    public function adminIndex(Request $request)
    {
        $sortableFields = [
            'ml_id',
            'server_id',
            'pelaku_nickname',
            'korban_nickname',
            'tanggal_kejadian',
            'created_at',
            'updated_at',
        ];

        $sortBy = $request->query('sort_by');
        $sortOrder = $request->query('sort_order', 'desc');
        $search = $request->query('search', '');

        if (!in_array($sortBy, $sortableFields)) {
            $sortBy = 'created_at';
        }

        if (!in_array(strtolower($sortOrder), ['asc', 'desc'])) {
            $sortOrder = 'desc';
        }

        $query = DangerousAccount::query();

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('ml_id', 'like', '%' . $search . '%')
                    ->orWhere('pelaku_nickname', 'like', '%' . $search . '%')
                    ->orWhere('korban_nickname', 'like', '%' . $search . '%');
            });
        }

        $dangerousAccounts = $query->orderBy($sortBy, $sortOrder)->paginate(10);

        return view('admin.dangerous_accounts.index', [
            'dangerousAccounts' => $dangerousAccounts,
            'sortBy' => $sortBy,
            'sortOrder' => $sortOrder,
            'search' => $search,
        ]);
    }

    public function adminCreate()
    {
        return view('admin.dangerous_accounts.create');
    }

    public function adminStore(Request $request)
    {
        $request->validate([
            'ml_id' => 'required',
            'bukti_kasus' => 'nullable|array',
            'bukti_kasus.*' => 'file|mimes:jpg,jpeg,png|max:2048',
        ]);

        try {
            $buktiPaths = [];
            if ($request->hasFile('bukti_kasus')) {
                foreach ($request->file('bukti_kasus') as $file) {
                    $buktiPaths[] = $file->store('bukti', 'public');
                }
            }

            DangerousAccount::create([
                'ml_id' => $request->ml_id,
                'server_id' => $request->server_id,
                'pelaku_nickname' => $request->pelaku_nickname,
                'korban_nickname' => $request->korban_nickname,
                'tanggal_kejadian' => $request->tanggal_kejadian,
                'bukti_file_path' => json_encode($buktiPaths),
                'kronologi' => $request->kronologi,
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['upload_error' => 'Error uploading files: ' . $e->getMessage()])->withInput();
        }

        return redirect()->route('admin.dangerous_accounts.index')->with('success', 'Dangerous account created successfully!');
    }

    public function adminEdit($id)
    {
        $dangerousAccount = DangerousAccount::findOrFail($id);
        return view('admin.dangerous_accounts.edit', compact('dangerousAccount'));
    }

    public function adminUpdate(Request $request, $id)
    {
        $dangerousAccount = DangerousAccount::findOrFail($id);

        $request->validate([
            'ml_id' => 'required',
            'bukti_kasus' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
            'header_picture' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
        ]);

        try {
            $buktiPaths = json_decode($dangerousAccount->bukti_file_path, true) ?? [];
            if ($request->hasFile('bukti_kasus')) {
                $file = $request->file('bukti_kasus');
                $filePath = $file->store('bukti', 'public');
                $buktiPaths = [$filePath]; // store as array with single file path
            }

            $headerPicturePath = $dangerousAccount->header_picture_path;
            if ($request->hasFile('header_picture')) {
                $headerFile = $request->file('header_picture');
                $headerPicturePath = $headerFile->store('header_pictures', 'public');
            }

            $dangerousAccount->update([
                'ml_id' => $request->ml_id,
                'server_id' => $request->server_id,
                'pelaku_nickname' => $request->pelaku_nickname,
                'korban_nickname' => $request->korban_nickname,
                'tanggal_kejadian' => $request->tanggal_kejadian,
                'bukti_file_path' => json_encode($buktiPaths),
                'header_picture_path' => $headerPicturePath,
                'kronologi' => $request->kronologi,
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['upload_error' => 'Error uploading file: ' . $e->getMessage()])->withInput();
        }

        return redirect()->route('admin.dangerous_accounts.index')->with('success', 'Dangerous account updated successfully!');
    }

    public function adminDestroy($id)
    {
        $dangerousAccount = DangerousAccount::findOrFail($id);
        $dangerousAccount->delete();

        return redirect()->route('admin.dangerous_accounts.index')->with('success', 'Dangerous account deleted successfully!');
    }

    public function show($id)
    {
        try {
            $dangerousAccount = DangerousAccount::where('ml_id', $id)->firstOrFail();
            return view('kasus_show', ['account' => $dangerousAccount]);
        } catch (ModelNotFoundException $e) {
            return redirect()->route('dangerous.index')->with('error', 'ML ID not found.');
        }
    }

    public function adminAccept($id)
    {
        $dangerousAccount = DangerousAccount::findOrFail($id);
        $dangerousAccount->is_accepted = true;
        $dangerousAccount->save();

        return redirect()->route('admin.dangerous_accounts.index')->with('success', 'Report accepted successfully!');
    }
}
