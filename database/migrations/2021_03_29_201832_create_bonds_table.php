<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateBondsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bonds', function (Blueprint $table) {
            $table->id();
            $table->foreignId('person_id')->comment('المساهم')->constrained("persons")->cascadeOnUpdate()->cascadeOnDelete();
            $table->integer('amount')->comment('المبلغ');
            $table->integer('days')->default(0)->comment('عدد الأيام');
            $table->boolean('active')->default(1)->comment('الحالة');
            $table->text('notes')->nullable()->comment('ملاحظات');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
        DB::statement("ALTER TABLE `bonds` comment 'السندات'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bonds');
    }
}
