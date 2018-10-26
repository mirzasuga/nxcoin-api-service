<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWithdrawsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('withdraws', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('wallet_id');
            $table->foreign('wallet_id')->references('id')->on('wallets');
            $table->double('amount',30,8);
            $table->string('receiver_address');
            $table->enum('status',['pending','confirmed','canceled']);
            $table->string('request_token');
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
        Schema::dropIfExists('withdraws', function(Blueprint $table) {
            
            $table->dropForeign(['wallet_id']);

        });
    }
}
