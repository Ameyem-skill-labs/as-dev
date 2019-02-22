<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssignTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assign_tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('assigned_by_userid');
            $table->integer('task_id');
            $table->integer('user_id');
            $table->integer('guide_id');
            $table->integer('reviewer_id');           
            $table->string('status')->nullable();
            $table->float('user_credits')->nullable();
            $table->float('guide_credits')->nullable();
            $table->float('reviewer_credits')->nullable();
            $table->date('target_at')->nullable();
            $table->date('completed_at')->nullable();
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
        Schema::dropIfExists('assign_tasks');
    }
}
