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
            'pendaftarTerbaru' => Pendaftar::with('user')->latest()->take(5)->get(),
            'profile' => $profile,
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
        $pendaftars = Pendaftar::all();
        $profile = Profile::first();
        return view('admin.laporan', compact('pendaftars', 'profile'));
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
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        $filename = time() . '_' . preg_replace('/[^A-Za-z0-9\-_.]/', '_', $request->file('image')->getClientOriginalName());
        $path = $request->file('image')->storeAs('public/gallery', $filename);

        Gallery::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => basename($path),
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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        $data = [
            'title' => $request->title,
            'description' => $request->description,
        ];

        if ($request->hasFile('image')) {
            if ($gallery->image && Storage::disk('public')->exists('gallery/' . $gallery->image)) {
                Storage::disk('public')->delete('gallery/' . $gallery->image);
            }

            $filename = time() . '_' . preg_replace('/[^A-Za-z0-9\-_.]/', '_', $request->file('image')->getClientOriginalName());
            $path = $request->file('image')->storeAs('public/gallery', $filename);
            $data['image'] = basename($path);
        }

        $gallery->update($data);

        return redirect()->route('admin.gallery.index')->with('success', 'Foto galeri berhasil diupdate.');
    }

    public function destroyGallery(Gallery $gallery)
    {
        if ($gallery->image && Storage::disk('public')->exists('gallery/' . $gallery->image)) {
            Storage::disk('public')->delete('gallery/' . $gallery->image);
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
            $filename = time() . '_' . preg_replace('/[^A-Za-z0-9\-_.]/', '_', $request->file('gambar')->getClientOriginalName());
            $path = $request->file('gambar')->storeAs('public/pengumuman', $filename);
            $data['gambar'] = basename($path);
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
            if ($pengumuman->gambar && Storage::disk('public')->exists('pengumuman/' . $pengumuman->gambar)) {
                Storage::disk('public')->delete('pengumuman/' . $pengumuman->gambar);
            }

            $filename = time() . '_' . preg_replace('/[^A-Za-z0-9\-_.]/', '_', $request->file('gambar')->getClientOriginalName());
            $path = $request->file('gambar')->storeAs('public/pengumuman', $filename);
            $data['gambar'] = basename($path);
        }

        $pengumuman->update($data);

        return redirect()->route('admin.pengumuman')->with('success', 'Pengumuman berhasil diperbarui.');
    }

    public function hapusPengumuman($id)
    {
        $pengumuman = Pengumuman::findOrFail($id);

        if ($pengumuman->gambar && Storage::disk('public')->exists('pengumuman/' . $pengumuman->gambar)) {
            Storage::disk('public')->delete('pengumuman/' . $pengumuman->gambar);
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

    public function pengaturan()
    {
        $profile = Profile::first();
        return view('admin.pengaturan', compact('profile'));
    }

    public function updateProfil(Request $request)
    {
        $request->validate([
            'nama_sekolah' => 'required|string|max:255',
            'npsn' => 'nullable|string|max:20',
            'akreditasi' => 'required|string|in:Unggul,A,B,C',
            'tahun_berdiri' => 'nullable|integer|min:1900|max:' . date('Y'),
            'alamat' => 'required|string',
            'kepala_sekolah' => 'required|string|max:255',
            'sambutan' => 'nullable|string',
            'foto_kepsek' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $profile = Profile::firstOrCreate([]);

        if ($request->hasFile('foto_kepsek')) {
            if ($profile->foto_kepsek && Storage::disk('public')->exists('profiles/' . $profile->foto_kepsek)) {
                Storage::disk('public')->delete('profiles/' . $profile->foto_kepsek);
            }
            
            $filename = 'kepsek-' . time() . '.' . $request->file('foto_kepsek')->getClientOriginalExtension();
            $path = $request->file('foto_kepsek')->storeAs('public/profiles', $filename);
            $profile->foto_kepsek = basename($path);
        }

        $profile->update($request->except(['foto_kepsek']));

        return redirect()->back()->with('success', 'Profil sekolah berhasil diupdate!');
    }
}

