<?php

namespace App\Exports;

use App\Models\Profile;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class LaporanPpdbExport implements FromCollection, WithHeadings, WithMapping, WithStyles, ShouldAutoSize, WithColumnFormatting, WithEvents
{
    protected Collection $pendaftars;
    protected ?Profile $profile;

    public function __construct(Collection $pendaftars)
    {
        $this->pendaftars = $pendaftars;
        $this->profile = Profile::first();
    }

    public function collection()
    {
        return $this->pendaftars;
    }

    public function headings(): array
    {
        return ['No', 'Nama Lengkap', 'NISN', 'Sekolah Asal', 'Status', 'Tanggal Daftar'];
    }

    public function map($row): array
    {
        // Row is Pendaftar model
        $created = $row->created_at ? Carbon::parse($row->created_at)->format('d/m/Y') : '-';

        // Deterministic index: use the collection order
        $index = $this->pendaftars->search(fn ($x) => $x->id === $row->id);
        $no = $index === false ? 0 : ($index + 1);

        return [
            $no,
            $row->nama_lengkap,
            $row->nisn,
            $row->nama_sekolah,
            $row->status,
            $created,
        ];
    }

    public function styles($sheet)
    {
        // Styling via AfterSheet.
        return [];
    }

    public function columnFormatting(): array
    {
        return [
            'A' => DataType::TYPE_NUMERIC,
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $worksheet = $event->sheet->getDelegate();

                // Logo path
                $logoPath = public_path('images/logo/logo-removebg-preview.jpg');
                if (!file_exists($logoPath)) {
                    $alt = public_path('images/logo/siswa-smp-sd.png');
                    $logoPath = file_exists($alt) ? $alt : null;
                }

                // Header
                $worksheet->mergeCells('A1:F1');
                $worksheet->mergeCells('A2:F2');
                $worksheet->mergeCells('A3:F3');

                $worksheet->setCellValue('A1', 'SMPN 1 PIRIME');
                $worksheet->setCellValue('A2', 'Laporan PPDB - Ringkasan Pendaftaran Siswa Baru');
                $worksheet->setCellValue('A3', 'Dibuat pada: ' . Carbon::now()->format('d F Y, H:i') . ' WIB');

                $worksheet->getStyle('A1:F2')->getFont()->setBold(true);
                $worksheet->getStyle('A1:F2')->getFont()->setSize(14);
                $worksheet->getStyle('A1:F2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $worksheet->getStyle('A3')->getFont()->setSize(10);
                $worksheet->getStyle('A3')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

                // Shift headings + data down so row 1-3 are reserved for header.
                $worksheet->insertNewRowBefore(1, 3);

                if ($logoPath) {
                    $drawing = new Drawing();
                    $drawing->setName('Logo');
                    $drawing->setDescription('Logo');
                    $drawing->setPath($logoPath);
                    $drawing->setHeight(48);
                    $drawing->setCoordinates('A1');
                    $drawing->setWorksheet($worksheet);
                }

                // After inserting rows, headings will be at row 4.
                $headingRow = 4;
                $highestRow = $worksheet->getHighestRow();

                // Style column headings
                $headerRange = 'A' . $headingRow . ':F' . $headingRow;
                $worksheet->getStyle($headerRange)->getFont()->setBold(true);
                $worksheet->getStyle($headerRange)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $worksheet->getStyle($headerRange)->getFill()->setFillType(Fill::FILL_SOLID);
                $worksheet->getStyle($headerRange)->getFill()->getStartColor()->setRGB('0B5ED7');
                $worksheet->getStyle($headerRange)->getFont()->getColor()->setRGB('FFFFFF');

                // Borders for table
                $tableRange = 'A' . $headingRow . ':F' . $highestRow;
                $worksheet->getStyle($tableRange)->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['argb' => 'FF9CA3AF'],
                        ],
                    ],
                ]);

                // Center No + Status
                $dataFirstRow = $headingRow + 1;
                if ($highestRow >= $dataFirstRow) {
                    $worksheet->getStyle('A' . $dataFirstRow . ':A' . $highestRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                    $worksheet->getStyle('E' . $dataFirstRow . ':E' . $highestRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                }

                // Freeze panes
                $worksheet->freezePane('A' . $dataFirstRow);
            },

        ];
    }
}

