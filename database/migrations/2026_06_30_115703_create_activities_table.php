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
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('activity_category_id')->nullable()->constrained('activity_categories')->nullOnDelete();
            $table->string('slug')->unique();
            $table->string('cover_image')->nullable();
            $table->json('gallery')->nullable();
            $table->text('short_description')->nullable();
            $table->longText('detailed_description')->nullable();
            $table->text('objectives')->nullable();
            $table->text('expected_impact')->nullable();
            $table->string('duration')->nullable();
            $table->string('location')->nullable();
            $table->text('beneficiary_information')->nullable();
            $table->json('sdg_goals')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('internal_notes')->nullable();
            $table->string('status')->default('draft'); // draft, published, archived
            $table->json('attachments')->nullable();
            $table->string('pdf_brochure')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activities');
    }
};
