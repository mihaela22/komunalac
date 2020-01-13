<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('description', 1000);
            $table->string('address', 150);
            $table->float('latitude');
            $table->float('longitude');
            $table->string('image_user', 200)->nullable();
            $table->datetime('reported_at')->nullable();
            $table->datetime('processed_at')->nullable();
            $table->datetime('solved_at')->nullable();
            $table->string('solved_description', 1000)->nullable();
            $table->string('image_solved', 200)->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('category_id')->nullable();

            $table->foreign('user_id')
                ->references('id')
                ->on('users');
            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onUpdate('cascade')
                ->onDelete('set null');

            $table->index('user_id');
            $table->index('category_id');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reports');
    }
}
