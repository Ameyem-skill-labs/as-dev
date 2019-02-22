<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class coursetasks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coursetasks', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('task_id')->unsigned();
            $table->foreign('task_id')->references('id')->on('admin_tasks')
            ->onDelete('cascade');
            $table->integer('chapter_id')->unsigned();
            $table->foreign('chapter_id')->references('id')->on('chapters')
                ->onDelete('cascade');
            $table->integer('priority_guide_id')->unsigned();
            $table->foreign('priority_guide_id')->references('id')->on('users')
            ->onDelete('cascade');
            $table->integer('priority_reviewer_id')->unsigned();
            $table->foreign('priority_reviewer_id')->references('id')->on('users')
            ->onDelete('cascade');
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
        Schema::dropIfExists('coursetasks');
    }
}
