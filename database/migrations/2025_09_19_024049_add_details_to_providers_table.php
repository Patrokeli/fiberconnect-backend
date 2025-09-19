<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('providers', function (Blueprint $table) {
            $table->json('speeds')->nullable();
            $table->json('prices')->nullable();
            $table->text('installation')->nullable();
            $table->string('contract')->nullable();
            $table->string('coverage')->nullable();
            $table->decimal('rating', 3, 2)->nullable();
            $table->string('action_url')->nullable();
        });
    }

    public function down()
    {
        Schema::table('providers', function (Blueprint $table) {
            $table->dropColumn([
                'speeds',
                'prices',
                'installation',
                'contract',
                'coverage',
                'rating',
                'action_url',
            ]);
        });
    }

};
