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
    Schema::create('study_materials', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->string('exam_type')->nullable(); // e.g., NEET, UPSC, SSC, etc.
        $table->string('file_path'); // stored file path
        $table->enum('status', ['active', 'inactive'])->default('active');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('study_materials');
    }
};
