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
            $table->dropColumn('name');
            $table->string('first_name', 255)->after('id');
            $table->string('last_name', 255)->after('first_name');
            $table->date('birthday')->nullable()->after('last_name');
            $table->string('lot_block_sub', 255)->nullable()->after('birthday');
            $table->string('street', 255)->nullable()->after('lot_block_sub');
            $table->string('city', 255)->nullable()->after('street');
            $table->string('province', 255)->nullable()->after('city');
            $table->string('country', 255)->nullable()->after('province');
            $table->string('zip_code', 100)->nullable()->after('country');
            $table->string('phone_no', 100)->nullable()->after('zip_code');
            $table->string('username', 255)->nullable()->after('email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('name', 255)->after('id');

            $table->dropColumn('first_name');
            $table->dropColumn('last_name');
            $table->dropColumn('birthday');
            $table->dropColumn('lot_block_sub');
            $table->dropColumn('street');
            $table->dropColumn('city');
            $table->dropColumn('province');
            $table->dropColumn('country');
            $table->dropColumn('zip_code');
            $table->dropColumn('phone_no');
            $table->dropColumn('username');
        });
    }
};
