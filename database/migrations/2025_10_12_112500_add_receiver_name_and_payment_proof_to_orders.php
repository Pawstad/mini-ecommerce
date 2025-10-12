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
            if (!Schema::hasColumn('orders', 'receiver_name')) {
                $table->string('receiver_name')->nullable()->after('user_id');
            }
            if (!Schema::hasColumn('orders', 'payment_proof')) {
                $table->string('payment_proof')->nullable()->after('total');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            if (Schema::hasColumn('orders', 'payment_proof')) {
                $table->dropColumn('payment_proof');
            }
            if (Schema::hasColumn('orders', 'receiver_name')) {
                $table->dropColumn('receiver_name');
            }
        });
    }
};
