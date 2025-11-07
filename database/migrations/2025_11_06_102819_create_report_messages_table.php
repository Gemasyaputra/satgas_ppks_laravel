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
       Schema::create('report_messages', function (Blueprint $table) {
        $table->id();
        
        // Relasi ke laporan dan pengirim
        $table->foreignId('report_id')->constrained('reports')->onDelete('cascade');
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Sender
        
        $table->text('message');
        $table->enum('sender_role', ['student', 'admin']);
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('report_messages');
    }
};
