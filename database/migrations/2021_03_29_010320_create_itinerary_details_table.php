<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItineraryDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('itinerary_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('itinerary_id')->nullable()->comment('خط السير')->constrained("itineraries")->cascadeOnUpdate()->nullOnDelete();
            $table->foreignId('city_id')->nullable()->comment('المدينة')->constrained("cities")->cascadeOnUpdate()->nullOnDelete();
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
        Schema::dropIfExists('itinerary_details');
    }
}
