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
            $table->unsignedBigInteger('from');
            $table->float('amount');
            $table->boolean('credit_or_debit'); // 1 for credit and 0 for debit
            $table->unsignedBigInteger('to');
            $table->timestamps();

            $table->foreignId('from')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('to')->references('id')->on('users')->onDelete('cascade');
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
