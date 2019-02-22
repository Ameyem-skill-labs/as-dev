<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddInstructions2chapter extends Migration
{

    public function up()
    {
        Schema::table('chapters', function($table) {
            $table->longText('instructions')->after('name')->nullable();
            
        });
    }

    public function down()
    {
        Schema::table('chapters', function($table) {
            $table->dropColumn('instructions');           

        });
    }
}
