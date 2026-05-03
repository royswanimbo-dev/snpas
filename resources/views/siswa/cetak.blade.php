<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bukti Pendaftaran PPDB - SMP N 1 Pirime</title>
    <style>
        body { 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
            margin: 20px; 
            color: #333;
            line-height: 1.6;
        }
        .header { 
            text-align: center; 
            margin-bottom: 30px; 
            border-bottom: 3px double #1e40af;
            padding-bottom: 20px;
        }
        .logo {
            width: 100px;
            height: 100px;
            object-fit: contain;
            margin-bottom: 15px;
        }
        .header h1 {
            font-size: 24px;
            font-weight: bold;
            color: #1e3a8a;
            margin: 5px 0;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .header h2 {
            font-size: 20px;
            font-weight: bold;
            color: #2563eb;
            margin: 5px 0;
        }
        .header p {
            font-size: 14px;
            color: #666;
            margin: 5px 0;
        }
        .content { margin: 20px 0; }
        table { 
            width: 100%; 
            border-collapse: collapse; 
            margin: 15px 0; 
            font-size: 14px;
        }
        th { 
            background-color: #1e40af; 
            color: white;
            padding: 10px 12px;
            text-align: left;
            font-weight: 600;
            border: 1px solid #1e3a8a;
        }
        td { 
            border: 1px solid #d1d5db; 
            padding: 8px 12px; 
            text-align: left; 
        }
        tr:nth-child(even) {
            background-color: #f8fafc;
        }
        .label {
            width: 40%;
            font-weight: 600;
            color: #374151;
            background-color: #f1f5f9;
        }
        .value {
            width: 60%;
            color: #1f2937;
        }
        .footer { 
            margin-top: 40px; 
            text-align: center; 
            border-top: 2px solid #e5e7eb;
            padding-top: 20px;
        }
        .footer p {
            font-size: 12px;
            color: #6b7280;
            margin: 3px 0;
        }
        .status-menunggu { color: #d97706; font-weight: bold; }
        .status-diterima { color: #059669; font-weight: bold; }
        .status-ditolak { color: #dc2626; font-weight: bold; }
        @media print {
            body { margin: 0; padding: 15px; }
            .no-print { display: none; }
        }
    </style>
</head>
<body>
    <div class="header">
        @if($logoBase64)
            <img src="data:image/jpeg;base64,{{ $logoBase64 }}" alt="Logo SMP N 1 Pirime" class="logo">
        @endif
        <h1>SMP Negeri 1 Pirime</h1>
        <h2>Bukti Pendaftaran PPDB</h2>
        <p>Tahun Ajaran {{ date('Y') }}/{{ date('Y')+1 }}</p>
    </div>

    <div class="content">
        @if($pendaftar)
        <table>
            <tr>
                <th colspan="2">DATA PENDAFTAR</th>
            </tr>
            <tr>
                <td class="label">Nomor Pendaftaran</td>
                <td class="value">: {{ $pendaftar->nomor_pendaftaran ?? 'Belum ada' }}</td>
            </tr>
            <tr>
                <td class="label">Nama Lengkap</td>
                <td class="value">: {{ $pendaftar->nama_lengkap ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label">NISN</td>
                <td class="value">: {{ $pendaftar->nisn ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label">NIK</td>
                <td class="value">: {{ $pendaftar->nik ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label">Jenis Kelamin</td>
                <td class="value">: {{ $pendaftar->jenis_kelamin ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label">Tempat, Tanggal Lahir</td>
                <td class="value">: {{ $pendaftar->tempat_lahir ?? '-' }}, {{ $pendaftar->tanggal_lahir ? $pendaftar->tanggal_lahir->format('d F Y') : '-' }}</td>
            </tr>
            <tr>
                <td class="label">Agama</td>
                <td class="value">: {{ $pendaftar->agama ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label">No. HP Siswa</td>
                <td class="value">: {{ $pendaftar->no_hp_siswa ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label">Alamat Lengkap</td>
                <td class="value">: {{ $pendaftar->alamat ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label">Desa/Kelurahan</td>
                <td class="value">: {{ $pendaftar->desa ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label">Kecamatan</td>
                <td class="value">: {{ $pendaftar->kecamatan ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label">Kabupaten/Kota</td>
                <td class="value">: {{ $pendaftar->kabupaten ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label">Provinsi</td>
                <td class="value">: {{ $pendaftar->provinsi ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label">Anak Ke</td>
                <td class="value">: {{ $pendaftar->anak_ke ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label">Jumlah Saudara</td>
                <td class="value">: {{ $pendaftar->jumlah_saudara ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label">Sekolah Asal</td>
                <td class="value">: {{ $pendaftar->nama_sekolah ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label">NPSN Sekolah</td>
                <td class="value">: {{ $pendaftar->npsn ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label">Alamat Sekolah</td>
                <td class="value">: {{ $pendaftar->alamat_sekolah ?? '-' }}</td>
            </tr>
        </table>

        <table>
            <tr>
                <th colspan="2">DATA ORANG TUA / WALI</th>
            </tr>
            <tr>
                <td class="label">Nama Ayah</td>
                <td class="value">: {{ $pendaftar->nama_ayah ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label">Pendidikan Ayah</td>
                <td class="value">: {{ $pendaftar->pendidikan_ayah ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label">Pekerjaan Ayah</td>
                <td class="value">: {{ $pendaftar->pekerjaan_ayah ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label">No. HP Ayah</td>
                <td class="value">: {{ $pendaftar->no_hp_ayah ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label">Nama Ibu</td>
                <td class="value">: {{ $pendaftar->nama_ibu ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label">Pendidikan Ibu</td>
                <td class="value">: {{ $pendaftar->pendidikan_ibu ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label">Pekerjaan Ibu</td>
                <td class="value">: {{ $pendaftar->pekerjaan_ibu ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label">No. HP Ibu</td>
                <td class="value">: {{ $pendaftar->no_hp_ibu ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label">Penghasilan Orang Tua</td>
                <td class="value">: {{ $pendaftar->penghasilan_orangtua ?? '-' }}</td>
            </tr>
        </table>

        <table>
            <tr>
                <th colspan="2">STATUS PENDAFTARAN</th>
            </tr>
            <tr>
                <td class="label">Status</td>
                <td class="value">: 
                    @if($pendaftar->status == 'Menunggu')
                        <span class="status-menunggu">{{ $pendaftar->status }}</span>
                    @elseif($pendaftar->status == 'Diterima')
                        <span class="status-diterima">{{ $pendaftar->status }}</span>
                    @elseif($pendaftar->status == 'Ditolak')
                        <span class="status-ditolak">{{ $pendaftar->status }}</span>
                    @else
                        {{ $pendaftar->status ?? '-' }}
                    @endif
                </td>
            </tr>
            <tr>
                <td class="label">Tanggal Pendaftaran</td>
                <td class="value">: {{ $pendaftar->created_at ? $pendaftar->created_at->format('d F Y') : '-' }}</td>
            </tr>
            @if($pendaftar->catatan_admin)
            <tr>
                <td class="label">Catatan Admin</td>
                <td class="value">: {{ $pendaftar->catatan_admin }}</td>
            </tr>
            @endif
        </table>
        @else
        <div style="text-align: center; padding: 40px; color: #666;">
            <h3>Data pendaftar tidak ditemukan.</h3>
        </div>
        @endif
    </div>

    <div class="footer">
        <p><strong>SMP Negeri 1 Pirime</strong></p>
        <p>Bukti pendaftaran ini dicetak secara otomatis pada {{ date('d F Y H:i:s') }}</p>
        <p>Harap simpan bukti pendaftaran ini sebagai referensi.</p>
    </div>
</body>
</html>

