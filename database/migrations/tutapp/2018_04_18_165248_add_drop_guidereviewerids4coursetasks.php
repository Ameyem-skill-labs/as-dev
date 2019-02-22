<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDropGuidereviewerids4coursetasks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('coursetasks', function($table) {
            $table->dropForeign(['priority_guide_id']);
            $table->dropColumn('priority_guide_id');
            $table->dropForeign(['priority_reviewer_id']);   
            $table->dropColumn('priority_reviewer_id');  

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
