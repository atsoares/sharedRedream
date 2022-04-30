<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;

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
            $table->decimal('value');
            $table->boolean('active')->default(true);
            $table->foreignIdFor(User::class)->nullable();
            $table->datetime('refunded_at')->nullable(); 
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
        Schema::dropIfExists('redeem_vouchers');
    }
}
