<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->id();
            $table->string('group_name')->nullable();
            $table->bigInteger('group_user_id_1')->nullable();
            $table->bigInteger('group_user_id_2')->nullable();
            $table->bigInteger('group_user_id_3')->nullable();
            $table->bigInteger('group_user_id_4')->nullable();
            $table->bigInteger('publicexecutecard_1')->nullable();
            $table->bigInteger('publicexecutecard_2')->nullable();
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
        Schema::dropIfExists('groups');
    }
}
