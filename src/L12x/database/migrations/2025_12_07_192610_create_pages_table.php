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
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('url', 2000);
            $table->string('title', 200)->nullable();
            $table->string('source_url', 2000)->nullable();
            $table->string('og_image_url', 2000)->nullable();
            $table->string('comments_url', 2000)->nullable();
            $table->longText('source')->nullable();
            $table->integer('version')->default(1);
            $table->string('state', 20)->default('to process'); // to process, active, deleted
            $table->timestamps();

            $table->fullText('source');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        /*Schema::table('pages', function (Blueprint $table) {
            $table->dropFullText('pages_source_fulltext');
        });*/
        Schema::dropIfExists('pages');        
    }
};
