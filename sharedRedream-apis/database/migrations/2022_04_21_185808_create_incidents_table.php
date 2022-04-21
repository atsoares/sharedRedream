<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncidentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incidents', function (Blueprint $table) {
            $table->id();
            $table->string('title', 50)->unique(); 
            $table->string('description', 200); 
            $table->unsignedInteger('user_id'); 
            $table->double('goal_value', 10, 2);
            $table->double('total_raised', 10, 2)->nullable();
            $table->boolean('active')->default(true);
            $table->boolean('refunded')->default(false);
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
        Schema::dropIfExists('incidents');
    }
}
