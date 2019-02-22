<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCoursechapterid2assignTasks extends Migration
{
      /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('assign_tasks', function($table) {

            $table->integer('course_chapter_id')->after('reviewer_id')->nullable();
            // $table->foreign('course_task_id')->references('id')
            // ->on('coursetasks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('assign_tasks', function($table) {
            $table->dropColumn('course_chapter_id');
           
        });
    }
}
