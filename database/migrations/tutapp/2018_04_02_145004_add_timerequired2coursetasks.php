<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTimerequired2coursetasks extends Migration
{
    public function up()
    {
        Schema::table('coursetasks', function($table) {

            $table->integer('time_required')->after('priority_reviewer_id')->nullable();
            // $table->foreign('course_task_id')->references('id')
            // ->on('coursetasks')->onDelete('cascade');
            $table->unique(array('task_id', 'chapter_id'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('coursetasks', function($table) {
            $table->dropColumn('time_required');
           
        });
    }
}