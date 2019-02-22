<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddGuideNreviewers2enrolments extends Migration
{
    public function up()
    {
        Schema::table('enrollments', function($table) {
            $table->integer('guide_id')->after('student_id')->unsigned();    
            $table->integer('reviewer_id')->after('guide_id')->unsigned();   
            $table->float('guide_rating')->nullable();   
            $table->float('reviewer_rating')->nullable(); 
            $table->float('course_rating')->nullable();   
            $table->longtext('comment')->nullable(); 
            

        });
    }

    public function down()
    {
        Schema::table('enrollments', function($table) {
            $table->dropColumn('guide_id');   
            $table->dropColumn('reviewer_id');  
            $table->dropColumn('guide_rating');   
            $table->dropColumn('reviewer_rating');
            $table->dropColumn('course_rating');   
            $table->dropColumn('comment');
        });
    }
}
