<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Pendaftar;
use App\Models\Pengumuman;
use App\Models\Profile;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function index()
    {
        $profile = Profile::first();
        return view('admin.dashboard', [
            'jumlahPendaftar' => Pendaftar::count(),
            'belumVerifikasi' => Pendaftar::where('status', 'Menunggu')->count(),
            'sudahDiverifikasi' => Pendaftar::where('status', '!=', 'Menunggu')->count(),
            'diterima' => Pendaftar::where('status', 'Diterima')->count(),
            'ditolak' => Pendaftar::where('status', 'Ditolak')->count(),
            'profile' => $profile,
            'pendaftarTerbaru' => Pendaftar::with('user')->latest()->take(8)->get(),
        ]);
    }

    public function pendaftar()
    {
        $pendaftars = Pendaftar::with('user')->get();
        $profile = Profile::first();
        return view('admin.pendaftar', compact('pendaftars', 'profile'));
    }

    public function detailPendaftar($id)
    {
        $pendaftar = Pendaftar::with('user')->findOrFail($id);
        $profile = Profile::first();
        return view('admin.detail', compact('pendaftar', 'profile'));
    }

    public function verifikasi(Request $request, $id)
    {
        $pendaftar = Pendaftar::findOrFail($id);
        $pendaftar->status = $request->status;
        $pendaftar->catatan_admin = $request->catatan_admin ?? null;
        $pendaftar->save();

        return back()->with('success', 'Status pendaftar berhasil diperbarui.');
    }

    public function laporan()
    {
        $pendaftars = Pendaftar::with('user')->latest('created_at')->get();
        $profile = Profile::first();
        return view('admin.laporan', compact('pendaftars', 'profile'));
    }

    public function exportLaporanExcel()
    {
        $pendaftars = Pendaftar::with('user')->latest('created_at')->get();

        return \Maatwebsite\Excel\Facades\Excel::download(
            new \App\Exports\LaporanPpdbExport($pendaftars),
            'laporan_ppdb_' . now()->format('Y-m-d') . '.xlsx'
        );
    }


    // Gallery Methods
    public function gallery()
    {
        $galleries = Gallery::terbaru()->get();
        $profile = Profile::first();
        return view('admin.gallery', compact('galleries', 'profile'));
    }


    public function createGallery()
    {
        $profile = Profile::first();
        return view('admin.buat-gallery', compact('profile'));
    }

    public function storeGallery(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'kategori' => 'required|in:Kegiatan,Prestasi,Fasilitas,Guru,Siswa,Lainnya',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        $path = $request->file('image')->store('gallery', 'public');

        Gallery::create([
            'title' => $request->title,
            'description' => $request->description,
            'kategori' => $request->kategori,
            'image' => $path,
        ]);

        return redirect()->route('admin.gallery.index')->with('success', 'Foto galeri berhasil ditambahkan.');
    }

    public function editGallery(Gallery $gallery)
    {
        $profile = Profile::first();
        return view('admin.edit-gallery', compact('gallery', 'profile'));
    }

    public function updateGallery(Request $request, Gallery $gallery)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'kategori' => 'required|in:Kegiatan,Prestasi,Fasilitas,Guru,Siswa,Lainnya',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'kategori' => $request->kategori,
        ];

        if ($request->hasFile('image')) {
            if ($gallery->image && Storage::disk('public')->exists($gallery->image)) {
                Storage::disk('public')->delete($gallery->image);
            }

            $path = $request->file('image')->store('gallery', 'public');
            $data['image'] = $path;
        }

        $gallery->update($data);

        return redirect()->route('admin.gallery.index')->with('success', 'Foto galeri berhasil diupdate.');
    }

    public function destroyGallery(Gallery $gallery)
    {
        if ($gallery->image && Storage::disk('public')->exists($gallery->image)) {
            Storage::disk('public')->delete($gallery->image);
        }

        $gallery->delete();

        return redirect()->route('admin.gallery.index')->with('success', 'Foto galeri berhasil dihapus.');
    }

    // Pengumuman Methods
    public function pengumuman()
    {
        $pengumumans = Pengumuman::terbaru()->get();
        $profile = Profile::first();
        return view('admin.pengumuman', compact('pengumumans', 'profile'));
    }

    public function buatPengumuman()
    {
        $profile = Profile::first();
        return view('admin.buat-pengumuman', compact('profile'));
    }

    public function simpanPengumuman(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'jenis' => 'required|in:informasi,pengumuman,penting',
            'aktif' => 'boolean',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if (empty(trim($request->isi))) {
            return back()->withErrors(['isi' => 'Isi pengumuman tidak boleh kosong.'])->withInput();
        }

        $data = [
            'judul' => $request->judul,
            'isi' => $request->isi,
            'jenis' => $request->jenis,
            'aktif' => $request->boolean('aktif'),
            'tanggal_publish' => now(),
        ];

        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('pengumuman', 'public');
            $data['gambar'] = $path;
        }

        Pengumuman::create($data);

        return redirect()->route('admin.pengumuman')->with('success', 'Pengumuman berhasil dibuat.');
    }

    public function editPengumuman($id)
    {
        $pengumuman = Pengumuman::findOrFail($id);
        $profile = Profile::first();
        return view('admin.edit-pengumuman', compact('pengumuman', 'profile'));
    }

    public function updatePengumuman(Request $request, $id)
    {
        $pengumuman = Pengumuman::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'jenis' => 'required|in:informasi,pengumuman,penting',
            'aktif' => 'boolean',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if (empty(trim($request->isi))) {
            return back()->withErrors(['isi' => 'Isi pengumuman tidak boleh kosong.'])->withInput();
        }

        $data = [
            'judul' => $request->judul,
            'isi' => $request->isi,
            'jenis' => $request->jenis,
            'aktif' => $request->boolean('aktif'),
        ];

        if ($request->hasFile('gambar')) {
            if ($pengumuman->gambar && Storage::disk('public')->exists($pengumuman->gambar)) {
                Storage::disk('public')->delete($pengumuman->gambar);
            }

            $path = $request->file('gambar')->store('pengumuman', 'public');
            $data['gambar'] = $path;
        }

        $pengumuman->update($data);

        return redirect()->route('admin.pengumuman')->with('success', 'Pengumuman berhasil diperbarui.');
    }

    public function hapusPengumuman($id)
    {
        $pengumuman = Pengumuman::findOrFail($id);

        if ($pengumuman->gambar && Storage::disk('public')->exists($pengumuman->gambar)) {
            Storage::disk('public')->delete($pengumuman->gambar);
        }

        $pengumuman->delete();

        return redirect()->route('admin.pengumuman')->with('success', 'Pengumuman berhasil dihapus.');
    }

    public function togglePengumuman($id)
    {
        $pengumuman = Pengumuman::findOrFail($id);
        $pengumuman->aktif = !$pengumuman->aktif;
        $pengumuman->save();

        $status = $pengumuman->aktif ? 'diaktifkan' : 'dinonaktifkan';
        return redirect()->route('admin.pengumuman')->with('success', 'Pengumuman berhasil ' . $status . '.');
    }

    // PRO: Update admin profile (name + photo) tersimpan di table `users`
    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ]);

        $user->name = $request->name;

        if ($request->hasFile('photo')) {
            // hapus file lama (kalau ada)
            if ($user->photo && Storage::disk('public')->exists($user->photo)) {
                Storage::disk('public')->delete($user->photo);
            }

            $file = $request->file('photo');
            $filename = time().'_'.$file->getClientOriginalName();
            $path = $file->storeAs('profile', $filename, 'public');
            $user->photo = $path;
        }

        $user->save();

        return back()->with('success', 'Profil admin berhasil diperbarui!');
    }

    public function pengaturan()
    {
        $profile = Profile::first();
        return view('admin.pengaturan', compact('profile'));
    }

    public function updateProfil(Request $request)
    {
        // profile sekolah (table `profiles`)
        // method ini tidak diubah.

        
        $request->validate([
            'nama_sekolah' => 'required|string|max:255',
            'npsn' => 'nullable|string|max:20',
            'akreditasi' => 'required|string|in:Unggul,A,B,C',
            'tahun_berdiri' => 'nullable|integer|min:1900|max:' . date('Y'),
            'alamat' => 'required|string',
            'kepala_sekolah' => 'required|string|max:255',
            'sambutan' => 'nullable|string',
            'visi' => 'nullable|string',
            'misi' => 'nullable|string',
            'total_siswa' => 'nullable|integer|min:0',
            'total_guru' => 'nullable|integer|min:0',
            'total_prestasi' => 'nullable|integer|min:0',
            'ppdb_open' => 'nullable|boolean',
            'foto_kepsek' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $profile = Profile::firstOrCreate([]);

        if ($request->hasFile('foto_kepsek')) {
            if ($profile->foto_kepsek && Storage::disk('public')->exists('profiles/' . $profile->foto_kepsek)) {
                Storage::disk('public')->delete('profiles/' . $profile->foto_kepsek);
            }
            

            $filename = 'kepsek-' . time() . '.' . $request->file('foto_kepsek')->getClientOriginalExtension();
            // simpan ke storage/app/public/profiles/
            $request->file('foto_kepsek')->storeAs('profiles', $filename, 'public');
            // DB simpan nama file saja
            $profile->foto_kepsek = $filename;
        }

        // Prepare data - convert misi line breaks to array
        $data = $request->except(['foto_kepsek']);

        // pastikan boolean sesuai checkbox (0/1)
        $data['ppdb_open'] = $request->boolean('ppdb_open');

        // Save sambutan_kepsek
        $data['sambutan_kepsek'] = $data['sambutan_kepsek'] ?? $request->sambutan_kepsek ?? '';

        // Convert misi to JSON array
        if (isset($data['misi']) && !empty($data['misi'])) {
            $misiLines = array_filter(array_map('trim', explode("\n", $data['misi'])));
            $data['misi'] = json_encode(array_values($misiLines));
        }

        $profile->update($data);

        return redirect()->back()->with('success', 'Profil sekolah berhasil diupdate!');
    }
}

