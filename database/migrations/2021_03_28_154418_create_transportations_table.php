<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateTransportationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transportations', function (Blueprint $table) {
            $table->foreignId('id')->primary()->comment('شركة الشحن')->constrained("companies")->cascadeOnUpdate()->cascadeOnDelete();
            $table->boolean('active')->default(1)->comment('الحالة');
            $table->timestamps();
        });
        DB::statement("ALTER TABLE `transportations` comment 'شركات الشحن'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transportations');
    }
}
