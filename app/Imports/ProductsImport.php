<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsErrors;

class ProductsImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnError
{
    use SkipsErrors;

    public function model(array $row)
    {
        return new Product([
            'tenant_id' => auth()->user()->tenant_id,
            'branch_id' => auth()->user()->branch_id,
            'barcode' => $row['barcode'],
            'name' => $row['product_name'],
            'manufacturer' => $row['manufacturer'],
            'quantity' => $row['quantity'],
            'unit' => $row['unit'],
            'capital_price' => $row['capital_price'],
            'markup_percentage' => $row['markup_percentage'] ?? 15,
            'date_procured' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['date_procured']),
            'manufactured_date' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['manufactured_date']),
            'expiration_date' => !empty($row['expiration_date']) ? \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['expiration_date']) : null,
            'is_active' => true,
        ]);
    }

    public function rules(): array
    {
        return [
            'barcode' => 'required|unique:products,barcode',
            'product_name' => 'required',
            'manufacturer' => 'required',
            'quantity' => 'required|numeric|min:0',
            'unit' => 'required',
            'capital_price' => 'required|numeric|min:0',
            'markup_percentage' => 'nullable|numeric|min:0|max:1000',
            'date_procured' => 'required',
            'manufactured_date' => 'required',
        ];
    }
}
