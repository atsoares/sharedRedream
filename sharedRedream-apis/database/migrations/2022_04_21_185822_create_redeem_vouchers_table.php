<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRedeemVouchersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('redeem_vouchers', function (Blueprint $table) {
            $table->id();
            $table->string('token', 20);
            $table->double('value', 10, 2);
            $table->boolean('active')->default(true);
            $table->unsignedInteger('user_id');
            $table->date('refunded_at'); 
            $table->timestamps();
            
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('redeem_vouchers');
    }
}
