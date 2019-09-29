<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateObjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('objects', function (Blueprint $table) {
            
            $table->bigIncrements('id');
            $table->string('name'); /* Part 8 */
            $table->bigInteger('user_id')->unsigned(); /* Part 8 */
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); /* Part 8 */
            $table->bigInteger('city_id')->unsigned(); /* Part 8 */
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade'); /* Part 8 */
            $table->text('description'); /* Part 8 */
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('objects');
    }
}
