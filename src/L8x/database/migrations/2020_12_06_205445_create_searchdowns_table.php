<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateSearchdownsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('searchdowns', function (Blueprint $table) {
            $table->id();
            $table->string('link');
            $table->text('markdown')->nullable();
            $table->timestamps();
        });

        DB::statement('ALTER TABLE searchdowns ADD FULLTEXT searchdowns_markdown_index (markdown)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('searchdowns');
    }
}
