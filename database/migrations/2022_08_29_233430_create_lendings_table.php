<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\LendingStatus;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lendings', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('lender_id');
            $table->float('amount_number');
            $table->string('amount_word', 120);
            $table->float('dues_amount', places: 2);
            $table->tinyInteger('dues_quantity');
            $table->tinyInteger('dues_current')->default(1);
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->foreign('lender_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lendings');
    }
};
