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
        Schema::table('users', function (Blueprint $table) {
            $table->string('first_name')->after('password')->nullable();
            $table->string('last_name')->after('first_name')->nullable();
            $table->string('mobile')->after('last_name')->nullable();
            $table->string('postcode')->after('mobile')->nullable();
            $table->date('dob')->after('postcode')->nullable();
            $table->string('gender')->after('dob')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('first_name');
            $table->dropColumn('last_name');
            $table->dropColumn('mobile');
            $table->dropColumn('postcode');
            $table->dropColumn('dob');
            $table->dropColumn('gender');
        });
    }
};
