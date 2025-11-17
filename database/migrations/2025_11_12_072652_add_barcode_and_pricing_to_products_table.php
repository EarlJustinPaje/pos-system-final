<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('barcode')->unique()->after('product_id');
            $table->decimal('markup_percentage', 5, 2)->default(15.00)->after('capital_price');
            $table->decimal('vat_amount', 10, 2)->default(0)->after('markup_percentage');
            $table->decimal('price_before_vat', 10, 2)->default(0)->after('vat_amount');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['barcode', 'markup_percentage', 'vat_amount', 'price_before_vat']);
        });
    }
};
