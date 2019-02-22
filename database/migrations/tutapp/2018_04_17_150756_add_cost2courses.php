<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCost2courses extends Migration
{
    public function up()
    {
        Schema::table('courses', function($table) {
            $table->float('cost')->after('status')->nullable();         
        });
    }

    public function down()
    {
        Schema::table('courses', function($table) {
            $table->dropColumn('cost');     
        });
    }
}
