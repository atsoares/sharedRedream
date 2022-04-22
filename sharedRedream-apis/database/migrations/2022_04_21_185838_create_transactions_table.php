<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('incident_id')->nullable(); 
            $table->unsignedInteger('redeem_voucher_id')->nullable(); 
            $table->enum('operation', ['voucher_redeem', 'incident_help', 'incident_refund']);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('incident_id')->references('id')->on('incidents');
            $table->foreign('redeem_voucher_id')->references('id')->on('redeem_vouchers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
