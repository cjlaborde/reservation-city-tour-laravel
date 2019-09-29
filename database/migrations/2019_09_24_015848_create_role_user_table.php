<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoleUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role_user', function (Blueprint $table) {
            
            $table->bigInteger('user_id')->unsigned(); /* Part 9 */
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); /* Part 9 */
            $table->bigInteger('role_id')->unsigned(); /* Part 9 */
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade'); /* Part 9 */
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('role_user');
    }
}