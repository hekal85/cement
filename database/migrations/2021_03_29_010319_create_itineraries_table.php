<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItinerariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('itineraries', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('خط السير');
            $table->foreignId('representative_id')->nullable()->comment('المندوب')->constrained('representatives')->cascadeOnUpdate()->nullOnDelete();
            $table->string('day1', 10)->comment('اليوم الأول');
            $table->string('day2', 10)->comment('اليوم الثانى');
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
        Schema::dropIfExists('itineraries');
    }
}
