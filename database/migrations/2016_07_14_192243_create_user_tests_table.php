<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_tests', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('key');
            $table->integer('user_id', false, true);
            $table->integer('course_id', false, true);
            $table->enum('active', ['enable', 'disable'])->default('disable');
            $table->integer('current')->default(0);
            $table->text('generation');
            $table->text('result');
            $table->integer('timeout', false, true)->default(0);
            $table->integer('score')->default(0);
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
        Schema::table('user_tests', function ($table) {
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('user_tests');
    }
}
