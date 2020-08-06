<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Query\Expression;

class CreateSubLyricsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_lyrics', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lyric_id')->constrained('lyrics')->onDelete('cascade');
            $table->json('lyric_content')->default(new Expression('(JSON_ARRAY())'));
            $table->string('lyric_language');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sub_lyrics');
    }
}
