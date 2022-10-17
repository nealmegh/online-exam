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
        Schema::create('mock_test_items', function (Blueprint $table) {
            $table->id();
            $table->text('text')->nullable();
            $table->string('type')->nullable();
            $table->integer('question_id')->nullable();
            $table->integer('mock_test_id')->nullable();
            $table->text('answer_text')->nullable();
            $table->text('correct_answer')->nullable();
            $table->text('user_answer')->nullable();
            $table->float('number')->nullable();
            $table->string('text_url')->nullable();
            $table->integer('number_answers')->nullable();
            $table->float('mark_distribution')->nullable();
            $table->integer('category_id')->nullable();
            $table->boolean('isPro')->nullable();
            $table->boolean('isCorrect')->nullable();
            $table->text('explanation')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mock_test_items');
    }
};
