<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOnlineQuizQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('online_quiz_questions', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->longText('question');
            $table->longText('optionA');
            $table->longText('optionB');
            $table->longText('optionC');
            $table->longText('optionD');
            $table->string('answer');
            $table->integer('online_quiz_id')->unsigned();
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
        Schema::dropIfExists('online_quiz_questions');
    }
}
