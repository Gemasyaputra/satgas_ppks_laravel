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
    Schema::table('users', function (Blueprint $table) {
        // Menambahkan kolom google_id yang boleh kosong (nullable)
        $table->string('google_id')->nullable()->after('email');
        // Password jadi nullable karena login google tidak butuh password (opsional, tapi disarankan)
        $table->string('password')->nullable()->change();
    });
}

public function down()
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn('google_id');
        // $table->string('password')->nullable(false)->change(); // Kembalikan jika perlu
    });
}
};
