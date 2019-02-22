<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminTaskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('institutes_id');
            $table->string('user_id');
            $table->string('worknature');
            $table->string('subject');
            $table->string('worktitle');
            $table->text('workdescription');
            $table->string('whatinitforme');
            $table->float('usercredits');
            $table->float('guidecredits');
            $table->float('reviewercredits');
            $table->string('uploads')->nullable(); 
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
        Schema::dropIfExists('admin_tasks');
    }
}
