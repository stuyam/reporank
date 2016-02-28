<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('repos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('username');
            $table->integer('rank');
            $table->integer('rank_language');
            $table->integer('stars');
            $table->integer('forks');
            $table->string('language');
            $table->text('badge');
            $table->text('badge_language');
            $table->timestamps();

            // set primary composite key
            $table->unique(['name', 'username']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('repos');
    }
}
