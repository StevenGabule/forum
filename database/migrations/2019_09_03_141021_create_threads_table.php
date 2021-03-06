<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateThreadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('threads', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->string('slug')->unique()->nullable();
            $table->unsignedBigInteger('channel_id');
            $table->unsignedBigInteger('replies_count')->default(0);
            $table->unsignedBigInteger('visits')->default(0);
            $table->string('title');
            $table->unsignedBigInteger('best_reply_id')->nullable();
            $table->text('body');
            $table->boolean('locked')->default(false);
            $table->timestamps();
            $table->foreign('best_reply_id')
                ->references('id')
                ->on('replies')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('threads');
    }
}
