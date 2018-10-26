<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trades', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('wallet_id');
            $table->unsignedInteger('user_id');
            $table->foreign('wallet_id')->references('id')->on('wallets');
            $table->foreign('user_id')->references('id')->on('users');
            $table->double('price',30,8);
            $table->double('amount',30,8);
            $table->string('pairs');
            $table->enum('type', ['buy','sell']);
            $table->enum('status', ['pending', 'canceled', 'matched']);
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
        Schema::dropIfExists('trades', function(Blueprint $table) {
            
            $table->dropForeign([
                'user_id',
                'wallet_id'
            ]);

        });
    }
}
