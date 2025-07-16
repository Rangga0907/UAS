<?php

namespace App\Http\Controllers;
use App\Models\Jamaah; 
use Illuminate\Http\Request;

class JamaahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    // Ambil keyword pencarian dari request
    $search = $request->input('search');

    // Query data jamaah
    $jamaah = Jamaah::query()
        ->when($search, function ($query, $search) {
            // Jika ada keyword pencarian, filter berdasarkan nama_lengkap
            return $query->where('nama_lengkap', 'like', "%{$search}%");
        })
        ->latest() // Urutkan berdasarkan data terbaru
        ->paginate(10); // Gunakan pagination

    // Kirim data ke view
    return view('jamaah.index', compact('jamaah'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         return view('jamaah.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       // 1. Validasi Input
    $request->validate([
        'nama_lengkap' => 'required|string|max:255',
        'alamat' => 'nullable|string',
        'no_telepon' => 'nullable|string|max:20',
        'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
        'tanggal_lahir' => 'nullable|date',
        'status_keaktifan' => 'required|boolean',
    ]);

    // 2. Simpan Data ke Database
    Jamaah::create($request->all());

    // 3. Redirect ke halaman index dengan pesan sukses
    return redirect()->route('jamaah.index')
                     ->with('success', 'Data jamaah berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jamaah $jamaah)
{
    // Laravel sudah otomatis mencari data berdasarkan ID dari URL.
    // Variabel $jamaah sudah berisi data lengkap yang cocok.
    return view('jamaah.edit', compact('jamaah'));
}

    /**
     * Update the specified resource in storage.
     */
   public function update(Request $request, Jamaah $jamaah)
{
    // 1. Validasi Input
    $request->validate([
        'nama_lengkap' => 'required|string|max:255',
        'alamat' => 'nullable|string',
        'no_telepon' => 'nullable|string|max:20',
        'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
        'tanggal_lahir' => 'nullable|date',
        'status_keaktifan' => 'required|boolean',
    ]);

    // 2. Update data di database
    $jamaah->update($request->all());

    // 3. Redirect ke halaman index dengan pesan sukses
    return redirect()->route('jamaah.index')
                     ->with('success', 'Data jamaah berhasil diperbarui.');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jamaah $jamaah)
{
    // Hapus data dari database
    $jamaah->delete();

    // Redirect ke halaman index dengan pesan sukses
    return redirect()->route('jamaah.index')
                     ->with('success', 'Data jamaah berhasil dihapus.');
}
}
