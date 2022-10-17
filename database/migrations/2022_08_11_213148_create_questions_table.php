<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->text('text')->nullable();
            $table->string('type')->nullable();
            $table->string('text_url')->nullable();
            $table->integer('number_answers')->nullable();
            $table->float('mark_distribution')->nullable();
            $table->integer('category_id')->nullable();
            $table->boolean('isPro')->nullable();
            $table->text('explanation')->nullable();
            $table->timestamps();
            $table->softDeletes('deleted_at');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questions');
    }
};
