<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Illuminate\Http\Request;
use App\Models\JenisPengaduan;
use App\Exports\ExportPengaduan;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

class PengaduanController extends Controller
{
    public function index(){
        $pengaduan = Pengaduan::where('user_id', Auth::id())
                         ->with('jenispengaduan') // Tambahkan eager loading
                         ->paginate(10);
        return view('dashboard.pengaduan.index', compact('pengaduan'));
    }

    public function create(){
        $jenispengaduan = JenisPengaduan::all(); // Fetch all jenis pengaduan
        return view('dashboard.pengaduan.create', compact('jenispengaduan'));
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'nama' => 'required|max:255|regex:/^[\p{L} ]+$/u',
            'jenis_id' =>'required|exists:jenis_pengaduans,id', //|exists:jenis_pengaduans,id
            'deskripsi' => 'required|max:255',
            'file' => 'file|mimes:pdf|max:1024',
            'no_telp' => 'required|digits_between:8,13',
        ],[
            'nama.required' => 'Nama harus diisi.',
            'nama.max' => 'Nama tidak boleh lebih dari 255 karakter.',
            'nama.regex' => 'Nama hanya boleh mengandung huruf dan spasi.',
            
            'jenis_id.required' => 'Jenis pengaduan harus dipilih.',
            'jenis_id.exists' => 'Jenis pengaduan yang dipilih tidak valid.',
            
            'deskripsi.required' => 'Deskripsi harus diisi.',
            'deskripsi.max' => 'Deskripsi tidak boleh lebih dari 255 karakter.',
            
            'file.file' => 'File harus berupa file.',
            'file.mimes' => 'File harus berupa dokumen PDF.',
            'file.max' => 'File tidak boleh lebih dari 1 MB.',
            
            'no_telp.required' => 'Nomor telepon harus diisi.',
            'no_telp.digits_between' => 'Nomor telepon harus terdiri dari 10 hingga 15 digit.',
        ]);
        
        if($request->file('file')){
            $validatedData['file'] = $request->file('file')->store('pengaduan-file');
        }

        $validatedData['user_id'] = Auth::id();
        Pengaduan::create($validatedData);

        return redirect('/dashboard/pengaduan/')->with("success", "Pengaduan berhasil ditambahkan!");
    }

    public function edit(Pengaduan $pengaduan){
        return view('dashboard.pengaduan.edit',[
            'pengaduan' => $pengaduan,
            'jenispengaduan' => JenisPengaduan::all()
        ]);
    }

    public function update(Request $request, Pengaduan $pengaduan){
    // Validasi data yang diterima dari request
    $validatedData = $request->validate([
        'nama' => 'required|max:255|regex:/^[\p{L} ]+$/u',
        'jenis_id' =>'required', //|exists:jenis_pengaduans,id
        'deskripsi' => 'required|max:255',
        'file' => 'required|file|mimes:pdf|max:1024',
        'no_telp' => 'required|digits_between:8,11',
    ]);

    // Jika ada file baru yang diunggah
    if ($request->file('file')) {
        // Hapus file lama jika ada
        if ($pengaduan->file) {
            Storage::disk('public')->delete($pengaduan->file);
        }

        // Simpan file baru
        $validatedData['file'] = $request->file('file')->store('pengaduan-file', 'public');
    }

    // Update data pengaduan
    $validatedData['user_id'] = Auth::id(); // Pastikan user_id tetap sama
    $pengaduan->update($validatedData);

    // Redirect dengan pesan sukses
    return redirect('/dashboard/pengaduan/')->with("success", "Pengaduan berhasil diperbarui!");
    }

    // public function destroy(Pengaduan $pengaduan){
    //     if($pengaduan->file){
    //         Storage::delete($pengaduan->file);
    //     }
    //     Pengaduan::destroy($pengaduan->id);
    //     return redirect('/dashboard/pengaduan/')->with("success", "Pengaduan berhasil dihapus!");
    // }

    public function adminIndex(Request $request){
        $pengaduan = Pengaduan::query();

        if ($request->filled('status')) {
            $pengaduan->where('status', $request->status);
        }

        $pengaduan = $pengaduan->paginate(10);

        return view('dashboard.pengaduan.admin.index', compact('pengaduan'));
    }

    public function adminTanggapan(Pengaduan $pengaduan){
        return view('dashboard.pengaduan.admin.tanggapan',[
            'pengaduan' => $pengaduan
        ]);
    }

    public function adminShow(Pengaduan $pengaduan){
        return view('dashboard.pengaduan.admin.show',[
            'pengaduan' => $pengaduan
        ]);
    }

    public function adminUpdate(Request $request, Pengaduan $pengaduan)
    {
        // Validasi input dari admin
        $validatedData = $request->validate([
            'tanggapan' => 'required', // Sesuaikan dengan kebutuhan
        ]);
    
        // Update tanggapan pengaduan
        $pengaduan->update([
            'tanggapan' => $validatedData['tanggapan']
        ]);
    
        // Redirect dengan pesan sukses
        return redirect('/dashboard/pengaduan/admin')->with('success', 'Tanggapan berhasil disimpan!');
    }

    public function setuju(Pengaduan $pengaduan){
        Pengaduan::where('id', $pengaduan->id)->update([
            'status' => 'disetujui'
        ]);

        return redirect('/dashboard/pengaduan/admin')->with("success", "Pengaduan disetujui!");
    }

    public function tolak(Pengaduan $pengaduan){
        Pengaduan::where('id', $pengaduan->id)->update([
            'status' => 'ditolak'
        ]);

        return redirect('/dashboard/pengaduan/admin')->with("success", "Pengaduan ditolak!");
    }

    public function setujuSemua(){
        Pengaduan::where('status', 'diproses')->update([
            'status' => 'disetujui'
        ]);

        return redirect('/dashboard/pengaduan/admin')->with("success", "Pengaduan disetujui!");
    }

    public function export_excel(){
        return Excel::download(new ExportPengaduan, 'pengaduan.xlsx');
    }

}
