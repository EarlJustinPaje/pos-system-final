<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class ProductsTemplateExport implements FromCollection, WithHeadings, WithStyles, WithColumnWidths
{
    public function collection()
    {
        // Return sample data
        return collect([
            [
                '1234567890123',
                'Sample Product 1',
                'Sample Manufacturer',
                '100',
                'pcs',
                '50.00',
                '15',
                '2024-01-15',
                '2023-12-01',
                '2025-12-31',
            ],
            [
                '9876543210987',
                'Sample Product 2',
                'Another Brand',
                '50',
                'kg',
                '120.50',
                '20',
                '2024-01-15',
                '2023-11-15',
                '',
            ],
        ]);
    }

    public function headings(): array
    {
        return [
            'Barcode *',
            'Product Name *',
            'Manufacturer *',
            'Quantity *',
            'Unit *',
            'Capital Price *',
            'Markup % *',
            'Date Procured *',
            'Manufactured Date *',
            'Expiration Date',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => [
                    'bold' => true,
                    'color' => ['rgb' => 'FFFFFF'],
                ],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'FF4500'],
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                ],
            ],
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 20,
            'B' => 30,
            'C' => 25,
            'D' => 12,
            'E' => 10,
            'F' => 15,
            'G' => 12,
            'H' => 18,
            'I' => 20,
            'J' => 18,
        ];
    }
}
