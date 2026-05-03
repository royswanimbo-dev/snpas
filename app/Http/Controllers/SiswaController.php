<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftar;
use App\Models\Pengumuman;

class SiswaController extends Controller
{
    public function dashboard()
    {
        $pendaftar = Pendaftar::where('user_id', auth()->id())->first();
        $pengumumans = Pengumuman::aktif()->terbaru()->take(3)->get();
        return view('siswa.dashboard', compact('pendaftar', 'pengumumans'));
    }

    public function formPendaftaran()
    {
        $pendaftar = Pendaftar::where('user_id', auth()->id())->first();
        return view('siswa.ppdb.create', compact('pendaftar'));
    }

    public function simpanPendaftaran(Request $request)
    {
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'nik' => 'required|string|max:16',
            'nisn' => 'nullable|string|max:10',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'agama' => 'required|string|max:50',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'no_hp_siswa' => 'nullable|string|max:15',
            'alamat' => 'required|string',
            'desa' => 'required|string|max:100',
            'kecamatan' => 'required|string|max:100',
            'kabupaten' => 'required|string|max:100',
            'provinsi' => 'required|string|max:100',
            'anak_ke' => 'nullable|integer',
            'jumlah_saudara' => 'nullable|integer',
            'nama_ayah' => 'required|string|max:255',
            'pendidikan_ayah' => 'nullable|string|max:100',
            'pekerjaan_ayah' => 'nullable|string|max:100',
            'no_hp_ayah' => 'nullable|string|max:15',
            'nama_ibu' => 'required|string|max:255',
            'pendidikan_ibu' => 'nullable|string|max:100',
            'pekerjaan_ibu' => 'nullable|string|max:100',
            'no_hp_ibu' => 'nullable|string|max:15',
            'penghasilan_orangtua' => 'nullable|string|max:100',
            'no_hp_orang_tua' => 'nullable|string|max:20',
            'alamat_orang_tua' => 'nullable|string',
            'nama_sekolah' => 'required|string|max:255',
            'npsn' => 'nullable|string|max:20',
            'alamat_sekolah' => 'nullable|string',
            'tahun_lulus' => 'nullable|string|max:4',
            'nilai_rata_rata' => 'nullable|numeric|between:0,100',
            'nomor_ijazah' => 'nullable|string|max:100',
            'foto_profil' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'kk' => 'nullable|mimes:jpg,jpeg,png,pdf|max:5120',
            'akte' => 'nullable|mimes:jpg,jpeg,png,pdf|max:5120',
            'ijazah' => 'nullable|mimes:jpg,jpeg,png,pdf|max:5120',
        ]);

        $pendaftar = Pendaftar::updateOrCreate(
            ['user_id' => auth()->id()],
            $validated
        );

        // Handle file uploads
        if ($request->hasFile('foto_profil')) {
            $pendaftar->foto_profil = $request->file('foto_profil')->store('berkas', 'public');
        }
        if ($request->hasFile('kk')) {
            $pendaftar->kk = $request->file('kk')->store('berkas', 'public');
        }
        if ($request->hasFile('akte')) {
            $pendaftar->akte = $request->file('akte')->store('berkas', 'public');
        }
        if ($request->hasFile('ijazah')) {
            $pendaftar->ijazah = $request->file('ijazah')->store('berkas', 'public');
        }

        $pendaftar->save();

        return redirect()
            ->route('siswa.dashboard')
            ->with('sukses', 'Pendaftaran berhasil dikirim. Menunggu verifikasi admin.');
    }

    public function berkas()
    {
        $pendaftar = Pendaftar::where('user_id', auth()->id())->first();
        return view('siswa.berkas', compact('pendaftar'));
    }

    public function uploadBerkas(Request $request)
    {
        $pendaftar = Pendaftar::where('user_id', auth()->id())->first();

        $request->validate([
            'foto_profil' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'kk' => 'nullable|mimes:jpg,png,jpeg,pdf|max:2048',
            'akte' => 'nullable|mimes:jpg,png,jpeg,pdf|max:2048',
            'ijazah' => 'nullable|mimes:jpg,png,jpeg,pdf|max:2048',
        ]);

        if ($request->hasFile('foto_profil')) {
            $pendaftar->foto_profil = $request->file('foto_profil')->store('berkas', 'public');
        }
        if ($request->hasFile('kk')) {
            $pendaftar->kk = $request->file('kk')->store('berkas', 'public');
        }
        if ($request->hasFile('akte')) {
            $pendaftar->akte = $request->file('akte')->store('berkas', 'public');
        }
        if ($request->hasFile('ijazah')) {
            $pendaftar->ijazah = $request->file('ijazah')->store('berkas', 'public');
        }

        $pendaftar->save();

        return back()->with('success', 'Berkas berhasil diupload!');
    }

    public function pengumuman()
    {
        $pengumumans = Pengumuman::aktif()->terbaru()->get();
        return view('siswa.pengumuman', compact('pengumumans'));
    }

    public function status()
    {
        $pendaftar = Pendaftar::where('user_id', auth()->id())->first();
        return view('siswa.status', compact('pendaftar'));
    }

    public function cetakPdf()
    {
        $pendaftar = Pendaftar::where('user_id', auth()->id())->first();

        // Encode logo ke base64 agar tampil di PDF
        $logoPath = public_path('images/logo/logo-removebg-preview.jpg');
        $logoBase64 = '';
        if (file_exists($logoPath)) {
            $logoBase64 = base64_encode(file_get_contents($logoPath));
        }

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('siswa.cetak', compact('pendaftar', 'logoBase64'));
        $pdf->setPaper('A4', 'portrait');
        return $pdf->stream('bukti-pendaftaran.pdf');
    }
}

