<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepositTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deposit', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('wallet_id');
            $table->foreign('wallet_id')->references('id')->on('wallets');
            $table->double('amount',30,8);
            $table->string('sender_address');
            $table->enum('status',['pending','confirmed','canceled']);
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
        Schema::dropIfExists('deposit', function(Blueprint $table) {
            
            $table->dropForeign(['wallet_id']);

        });
    }
}
