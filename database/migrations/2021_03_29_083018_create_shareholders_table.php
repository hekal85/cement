<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateShareholdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shareholders', function (Blueprint $table) {
            $table->foreignId('id')->primary()->comment('المساهم')->constrained("persons")->cascadeOnUpdate()->cascadeOnDelete();
            $table->boolean('active')->default(1)->comment('الحالة');
            $table->timestamps();
        });
        DB::statement("ALTER TABLE `shareholders` comment 'المساهمين'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shareholders');
    }
}
