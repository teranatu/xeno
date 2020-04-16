<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->bigInteger('group_id')->nullable();
            $table->bigInteger('card_1')->nullable();
            $table->bigInteger('card_2')->nullable();
            $table->bigInteger('publicexcute_user')->nullable();
            $table->bigInteger('investigate_user')->nullable();
            $table->bigInteger('seethrough_user')->nullable();
            $table->bigInteger('protection_user')->nullable();
            $table->bigInteger('plague_user')->nullable();
            $table->bigInteger('duel_user')->nullable();
            $table->bigInteger('select_user')->nullable();
            $table->bigInteger('exchange_user')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
