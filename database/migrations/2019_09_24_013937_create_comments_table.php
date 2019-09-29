<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            
            $table->bigIncrements('id');
            $table->text('content'); /* Part 8 */
            $table->string('commentable_type'); /* Part 8 */
            $table->bigInteger('commentable_id'); /* Part 8 */
            $table->integer('rating'); /* Part 8 */
            $table->bigInteger('user_id')->unsigned(); /* Part 8 */
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); /* Part 8 */
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}