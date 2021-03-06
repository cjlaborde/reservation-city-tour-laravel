<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            
            $table->bigIncrements('id');
            $table->date('day_in'); /* Part 9 */
            $table->date('day_out'); /* Part 9 */
            $table->boolean('status'); /* Part 9 */
            $table->bigInteger('user_id')->unsigned(); /* Part 9 */
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); /* Part 9 */
            $table->bigInteger('city_id')->unsigned(); /* Part 9 */
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade'); /* Part 9 */
            $table->bigInteger('room_id')->unsigned(); /* Part 9 */
            $table->foreign('room_id')->references('id')->on('rooms')->onDelete('cascade'); /* Part 9 */
            
            
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservations');
    }
}