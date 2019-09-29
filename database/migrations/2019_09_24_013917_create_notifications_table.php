<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            
            $table->bigIncrements('id');
            $table->string('content'); /* Part 8 */
            $table->boolean('status'); /* Part 8 */
            $table->bigInteger('user_id')->unsigned(); /* Part 8 */
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); /* Part 8 */
            $table->boolean('shown')->default(false); /* Part 8 */

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notifications');
    }
}
