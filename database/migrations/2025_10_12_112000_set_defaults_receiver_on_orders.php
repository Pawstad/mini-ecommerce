<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Set default empty string for receiver_address and receiver_phone so inserts without those fields succeed
        DB::statement("ALTER TABLE `orders` MODIFY `receiver_address` VARCHAR(255) NOT NULL DEFAULT ''");
        DB::statement("ALTER TABLE `orders` MODIFY `receiver_phone` VARCHAR(255) NOT NULL DEFAULT ''");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Remove default values (keep NOT NULL)
        DB::statement("ALTER TABLE `orders` MODIFY `receiver_address` VARCHAR(255) NOT NULL");
        DB::statement("ALTER TABLE `orders` MODIFY `receiver_phone` VARCHAR(255) NOT NULL");
    }
};
