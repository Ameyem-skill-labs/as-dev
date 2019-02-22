<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTaskcredsQuizscore2chapterstatuses extends Migration
{
    public function up()
    {
        Schema::table('chapterstatuses', function($table) {
            $table->float('task_credits')->after('status')->nullable();
            $table->float('quiz_score')->after('task_credits')->nullable();
            
        });
    }

    public function down()
    {
        Schema::table('chapterstatuses', function($table) {
            $table->dropColumn('task_credits');     
            $table->dropColumn('quiz_score');      

        });
    }
}
