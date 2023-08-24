<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->string('symbol')->unique();
            $table->string('name');
            $table->double('price');
            $table->double('changesPercentage');
            $table->double('change');
            $table->double('dayLow');
            $table->double('dayHigh');
            $table->double('yearLow');
            $table->double('yearHigh');
            $table->double('marketCap');
            $table->double('priceAvg50');
            $table->double('priceAvg200');
            $table->string('exchange');
            $table->double('volume');
            $table->double('avgVolume');
            $table->double('open');
            $table->double('previousClose');
            $table->double('eps');
            $table->double('pe');
            $table->dateTime('earningsAnnouncement');
            $table->double('sharesOutstanding');
            $table->double('timestamp');
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
        Schema::dropIfExists('stock');
    }
}
