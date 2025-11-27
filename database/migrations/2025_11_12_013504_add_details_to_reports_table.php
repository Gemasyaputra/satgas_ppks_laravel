<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('reports', function (Blueprint $table) {
            // Data Pelapor
            $table->string('reporter_email')->nullable();
            $table->string('reporter_name')->nullable(); // Bisa beda dengan nama akun user
            $table->string('reporter_pob')->nullable(); // Tempat lahir
            $table->date('reporter_dob')->nullable();   // Tanggal lahir
            $table->integer('reporter_age')->nullable();
            $table->string('reporter_occupation')->nullable();
            $table->string('reporter_nim')->nullable(); // Opsional
            $table->string('reporter_prodi')->nullable(); // Opsional
            $table->enum('reporter_gender', ['Laki-laki', 'Perempuan'])->nullable();
            $table->string('reporter_phone')->nullable();
            $table->text('reporter_address')->nullable();

            // Detail Kejadian
            $table->text('violence_type')->nullable(); // Jenis Kekerasan (Dinarasikan)
            $table->string('incident_location')->nullable();
            $table->string('disability_status')->nullable(); // Ya/Tidak + Keterangan
            
            // Data Terlapor
            $table->string('reported_party_name')->nullable();
            $table->string('reported_party_occupation')->nullable();
            $table->integer('reported_party_age')->nullable();
            
            // Tambahan
            $table->text('reason_for_reporting')->nullable();
            $table->string('witness_contact')->nullable(); // No HP pihak lain
            $table->text('victim_needs')->nullable();
            $table->date('report_date')->nullable(); // Tanggal Pelaporan manual
        });
    }

    public function down(): void
    {
        Schema::table('reports', function (Blueprint $table) {
            $table->dropColumn([
                'reporter_email', 'reporter_name', 'reporter_pob', 'reporter_dob', 
                'reporter_age', 'reporter_occupation', 'reporter_nim', 'reporter_prodi', 
                'reporter_gender', 'reporter_phone', 'reporter_address',
                'violence_type', 'incident_location', 'disability_status',
                'reported_party_name', 'reported_party_occupation', 'reported_party_age',
                'reason_for_reporting', 'witness_contact', 'victim_needs', 'report_date'
            ]);
        });
    }
};