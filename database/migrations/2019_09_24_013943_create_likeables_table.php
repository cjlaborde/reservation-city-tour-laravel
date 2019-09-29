<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLikeablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('likeables', function (Blueprint $table) {
            
            $table->string('likeable_type'); /* Part 8 */
            $table->bigInteger('likeable_id'); /* Part 8 */
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
        Schema::dropIfExists('likeables');
    }
}
