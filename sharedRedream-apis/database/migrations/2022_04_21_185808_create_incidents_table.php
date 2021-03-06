<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;

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
            $table->foreignIdFor(User::class);
            $table->decimal('total_raised')->nullable()->default(0);
            $table->decimal('goal');
            $table->date('expires_at')->default(now()->addMonth());
            $table->boolean('active')->default(true);
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
        Schema::dropIfExists('incidents');
    }
}
