<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftar;
use App\Models\Pengumuman;
use App\Models\Gallery;
use App\Models\Profile;
use Illuminate\Support\Facades\DB;

class PPDBController extends Controller
{
    public function home()
    {
        $profile = Profile::first();
        $pengumumans = Pengumuman::aktif()->terbaru()->take(6)->get();
        return view('home.index', compact('pengumumans', 'profile'));
    }

    public function galeri()
    {
        $galleries = Gallery::terbaru()->paginate(24);
        $profile = Profile::first();
        return view('galeri.index', compact('galleries', 'profile'));
    }

    public function ppdb()
    {
        $profile = Profile::firstOrCreate([]);
        $data = [
            'ppdb_online' => asset('/'), 
            'jadwal_mulai' => '2024-12-01', // Update with actual dates from profile or config
            'jadwal_selesai' => '2025-06-30',
        ];
        return view('ppdb.index', compact('profile', 'data'));
    }

    public function pengumuman()
    {
        $pengumumans = Pengumuman::aktif()->terbaru()->get();
        $pendaftars = Pendaftar::all();
        $total = $pendaftars->count();
        $diterima = $pendaftars->where('status', 'Diterima')->count();
        $diproses = $pendaftars->where('status', 'Menunggu')->count();
        $profile = Profile::first();
        return view('pengumuman.index', compact('pengumumans', 'total', 'diterima', 'diproses', 'profile'));
    }

    public function showPengumuman($id)
    {
        $pengumuman = Pengumuman::findOrFail($id);
        $profile = Profile::first();
        return view('pengumuman.show', compact('pengumuman', 'profile'));
    }

public function profil()
    {
        $profile = Profile::firstOrCreate(
            [],
            [
                'nama_sekolah' => 'SMPN 1 Pirime',
                'npsn' => '20929991',
                'status' => 'Negeri',
                'akreditasi' => 'A',
                'tahun_berdiri' => 1990,
                'kepala_sekolah' => 'Drs. Yohanis You',
                'alamat' => 'Jalan Raya Pirime, Desa Pirime, Halmahera Timur',
                'sambutan_kepsek' => 'Selamat datang di SMPN 1 Pirime. Kami siap mencetak generasi unggul!',
                'visi' => 'Menjadi SMP terbaik di Halmahera Timur',
                'misi' => json_encode(['Pendidikan berkualitas', 'Karakter mulia', 'Prestasi akademik', 'Fasilitas lengkap', 'Guru berkompeten']),
                'foto_kepsek' => null,
                'ppdb_open' => true,
                'total_siswa' => 500,
                'total_guru' => 40,
                'total_prestasi' => 20
            ]
        );
        
        // Get galleries for preview
        $galleries = Gallery::terbaru()->take(6)->get();
        
        $data = [
            'nama' => $profile->nama_sekolah,
            'npsn' => $profile->npsn,
            'jenis' => $profile->status,
            'akreditasi' => $profile->akreditasi,
            'tahun_berdiri' => $profile->tahun_berdiri,
            'kepala_sekolah' => $profile->kepala_sekolah,
            'alamat' => $profile->alamat,
            'sambutan' => $profile->sambutan_kepsek,
            'visi' => $profile->visi,
            'misi' => json_decode($profile->misi, true) ?? [],
            'ppdb_open' => $profile->ppdb_open ?? true,
            'total_siswa' => $profile->total_siswa ?? 500,
            'total_guru' => $profile->total_guru ?? 40,
            'total_prestasi' => $profile->total_prestasi ?? 20
        ];
        return view('profil.index', compact('data', 'profile', 'galleries'));
    }

    public function cekStatusPendaftaran(Request $request)
    {
        $nama = $request->query('nama');

        if (!$nama) {
            return response()->json([
                'success' => false,
                'message' => 'Nama siswa harus diisi'
            ]);
        }

        $pendaftar = Pendaftar::where(DB::raw('LOWER(nama_lengkap)'), 'LIKE', '%' . strtolower($nama) . '%')
            ->first();

        if (!$pendaftar) {
            return response()->json([
                'success' => false,
                'message' => 'Data pendaftaran dengan nama "' . $nama . '" tidak ditemukan.'
            ]);
        }

        $statusInfo = [
            'nama' => $pendaftar->nama_lengkap,
            'nomor_pendaftaran' => $pendaftar->nomor_pendaftaran,
            'status' => $pendaftar->status,
            'tanggal_daftar' => $pendaftar->created_at->format('d M Y'),
        ];

        $message = match ($pendaftar->status) {
            'Diterima' => "🎉 Selamat! Pendaftaran Anda DITERIMA.\n\n📋 Nomor: {$pendaftar->nomor_pendaftaran}\n👤 Nama: {$pendaftar->nama_lengkap}\n📅 Daftar: {$pendaftar->created_at->format('d M Y')}\n\nSilakan datang ke sekolah.",
            'Ditolak' => "❌ Maaf, pendaftaran belum diterima.\n\n📋 Nomor: {$pendaftar->nomor_pendaftaran}\n👤 Nama: {$pendaftar->nama_lengkap}\n📅 Daftar: {$pendaftar->created_at->format('d M Y')}" . ($pendaftar->catatan_admin ? "\n📝 Catatan: {$pendaftar->catatan_admin}" : '') . "\n\nHubungi admin.",
            default => "⏳ Pendaftaran sedang diproses.\n\n📋 Nomor: {$pendaftar->nomor_pendaftaran}\n👤 Nama: {$pendaftar->nama_lengkap}\n📅 Daftar: {$pendaftar->created_at->format('d M Y')}\n\nMohon tunggu.",
        };

        return response()->json([
            'success' => true,
            'data' => $statusInfo,
            'message' => $message
        ]);
    }
}

