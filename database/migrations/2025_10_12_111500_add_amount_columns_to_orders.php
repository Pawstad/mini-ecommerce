<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            if (!Schema::hasColumn('orders', 'quantity')) {
                $table->integer('quantity')->default(1)->after('product_id');
            }
            if (!Schema::hasColumn('orders', 'price')) {
                $table->decimal('price', 12, 2)->default(0)->after('quantity');
            }
            if (!Schema::hasColumn('orders', 'total')) {
                $table->decimal('total', 12, 2)->default(0)->after('price');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            if (Schema::hasColumn('orders', 'total')) {
                $table->dropColumn('total');
            }
            if (Schema::hasColumn('orders', 'price')) {
                $table->dropColumn('price');
            }
            if (Schema::hasColumn('orders', 'quantity')) {
                $table->dropColumn('quantity');
            }
        });
    }
};
