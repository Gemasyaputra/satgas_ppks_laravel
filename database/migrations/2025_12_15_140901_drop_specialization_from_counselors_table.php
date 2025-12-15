<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('counselors', function (Blueprint $table) {
            $table->dropColumn('specialization'); // Hapus kolom ini
        });
    }

    public function down()
    {
        Schema::table('counselors', function (Blueprint $table) {
            $table->string('specialization')->nullable(); // Kembalikan jika di-rollback
        });
    }
};
