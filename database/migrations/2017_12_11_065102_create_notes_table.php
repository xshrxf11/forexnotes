<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notes', function (Blueprint $table) {
            $table->increments('notes_id');
            $table->string('notes_news');
            $table->string('notes_currency');
            $table->string('notes_moving_market');
            $table->string('notes_prev');
            $table->string('notes_const');
            $table->string('notes_before_image');
            $table->string('notes_after_image');
            $table->boolean('notes_bloomberg_status');
            $table->mediumText('notes_summary');
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
        Schema::dropIfExists('notes');
    }
}
