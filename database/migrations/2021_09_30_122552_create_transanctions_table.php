<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransanctionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transanctions', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('amount');
            $table->string('currency');
            $table->string('flw_ref');
            $table->string('status');
            $table->string('tx_ref');
            $table->string('transaction_id');
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
        Schema::dropIfExists('transanctions');
    }
}
