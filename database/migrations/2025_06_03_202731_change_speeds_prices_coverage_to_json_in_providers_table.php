<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Change columns to JSON type
        Schema::table('providers', function (Blueprint $table) {
            $table->json('speeds')->nullable()->change();
            $table->json('prices')->nullable()->change();
            $table->json('coverage')->nullable()->change();
        });

        // Optional: convert existing data from string to JSON objects
        // If your DB stores strings properly formatted, this may be unnecessary,
        // but to be safe, you can run an update like:

        DB::table('providers')->get()->each(function ($provider) {
            DB::table('providers')->where('id', $provider->id)->update([
                'speeds' => json_decode($provider->speeds),
                'prices' => json_decode($provider->prices),
                'coverage' => json_decode($provider->coverage),
            ]);
        });
    }

    public function down(): void
    {
        // Revert JSON columns back to text (if needed)
        Schema::table('providers', function (Blueprint $table) {
            $table->text('speeds')->nullable()->change();
            $table->text('prices')->nullable()->change();
            $table->text('coverage')->nullable()->change();
        });
    }
};
