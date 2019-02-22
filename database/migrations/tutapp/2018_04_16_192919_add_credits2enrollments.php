<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCredits2enrollments extends Migration
{

    
    public function up()
    {
        Schema::table('enrollments', function($table) {
            $table->float('course_credits')->after('status')->nullable();
            $table->float('bonus_credits')->after('course_credits')->nullable();
            
        });
    }

    public function down()
    {
        Schema::table('enrollments', function($table) {
            $table->dropColumn('course_credits');     
            $table->dropColumn('bonus_credits');      

        });
    }
}
