<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLeaderIdToTableEntityUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('entity_users', function (Blueprint $table) {
            $table->unsignedBigInteger('leader_id')->nullable();
            $table->foreign('leader_id')->references('id')->on('users')->onUpdate('cascade')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('entity_users', function (Blueprint $table) {
            //
        });
    }
}
