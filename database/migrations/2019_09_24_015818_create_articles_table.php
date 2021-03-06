<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            
            $table->bigIncrements('id');
            $table->string('title'); /* Part 9 */
            $table->text('content'); /* Part 9 */
            $table->bigInteger('user_id')->unsigned(); /* Part 9 */
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); /* Part 9 */
            $table->bigInteger('object_id')->unsigned(); /* Part 9 */
            $table->foreign('object_id')->references('id')->on('objects')->onDelete('cascade'); /* Part 9 */
            $table->dateTime('created_at'); /* Part 9 */
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
