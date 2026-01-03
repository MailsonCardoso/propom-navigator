<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Fix typo: "vifgor" -> "vigor"
        \DB::table('questions')
            ->where('rationale', 'LIKE', '%vifgor%')
            ->update([
                    'rationale' => \DB::raw("REPLACE(rationale, 'vifgor', 'vigor')")
                ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert fix (optional, but good practice)
        \DB::table('questions')
            ->where('rationale', 'LIKE', '%vigor%')
            ->where('text', 'LIKE', '%bruscamente%') // Add text check to be safe
            ->update([
                    'rationale' => \DB::raw("REPLACE(rationale, 'vigor', 'vifgor')")
                ]);
    }
};
