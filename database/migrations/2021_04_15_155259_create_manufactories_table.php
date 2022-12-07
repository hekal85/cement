<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateManufactoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manufactories', function (Blueprint $table) {
            $table->foreignId('id')->primary()->comment('المصنع')->constrained("companies")->cascadeOnUpdate()->cascadeOnDelete();
            $table->boolean('active')->default(1)->comment('الحالة');
            $table->timestamps();
        });
        DB::statement("ALTER TABLE `manufactories` comment 'مصانع الأسمنت'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('manufactories');
    }
}
