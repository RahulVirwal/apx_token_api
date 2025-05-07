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
        Schema::create('berries_structures', function (Blueprint $table) {
            $table->id();
            $table->text('description');
            $table->string('berry_type');
            $table->string('farm_code');
            $table->string('batch_id');
            $table->date('harvest_date');
            $table->integer('quantity_grams');
            $table->json('certifications')->nullable();
            $table->float('carbon_offset_kg');
            $table->string('grower');
            $table->string('traceability_qr');
            $table->string('current_owner');
            $table->json('utility_tags')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('berries_structures');
    }
};
