<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
	        $table->unsignedBigInteger('status_id')->default(1);
	        $table->string('title');
	        $table->text('description');
            $table->string('photo');
            $table->bigInteger('to_user');
            $table->timestamps();


            $table->foreign('user_id')
	            ->references('id')
	            ->on('users')
	            ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
