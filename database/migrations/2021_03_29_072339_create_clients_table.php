<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->foreignId('id')->primary()->comment('العميل')->constrained("persons")->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('representative_id')->nullable()->comment('المندوب')->constrained("representatives")->cascadeOnUpdate()->nullOnDelete();
            $table->foreignId('itinerary_details_id')->nullable()->comment('خط السير')->constrained("itinerary_details")->cascadeOnUpdate()->nullOnDelete();
            $table->boolean('active')->default(1)->comment('الحالة');
            $table->timestamps();
        });
        DB::statement("ALTER TABLE `clients` comment 'العملاء'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
