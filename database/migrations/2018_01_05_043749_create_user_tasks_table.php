<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('assigntask_id');
            $table->string('request_for');
            $table->string('request_by');
            $table->string('message');
            $table->string('uploads')->nullable();
            // $table->string('obtained_marks')->nullable();
            $table->timestamp('created_at');
        });
    }  



    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_tasks');
    }
}
