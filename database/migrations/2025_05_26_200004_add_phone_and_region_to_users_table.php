<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPhoneAndRegionToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone')->nullable()->after('role');
            $table->enum('region', ['Arusha', 'Dar es Salaam', 'Dodoma', 'Mwanza', 'Mbeya', 'Morogoro', 'Tanga', 'Kilimanjaro', 'Zanzibar', 'Other'])->nullable()->after('phone');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['phone', 'region']);
        });
    }
}
