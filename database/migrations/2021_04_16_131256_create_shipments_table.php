<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateShipmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('manufactory_id')->comment('المصنع')->nullable()->constrained("manufactories")->cascadeOnUpdate()->nullOnDelete();
            $table->foreignId('transportation_id')->comment('شركة النقل')->nullable()->constrained("transportations")->cascadeOnUpdate()->nullOnDelete();
            $table->foreignId('driver')->comment('السائق')->nullable()->constrained("persons")->cascadeOnUpdate()->nullOnDelete();
            $table->unsignedInteger('payload')->default(0)->comment('الحمولة');
            $table->unsignedInteger('cost')->nullable()->comment('سعر الطن');
            $table->unsignedInteger('trans')->nullable()->comment('تكلفة النقل');
            $table->unsignedInteger('total')->nullable()->comment('التكلفة الإجمالية');
            $table->unsignedInteger('remaining')->default(0)->comment('المتبقي');
            $table->boolean('done')->default(0)->comment('تم التسليم');
            $table->text('notes')->nullable()->comment('ملاحظات');
            $table->timestamps();
        });
        DB::statement("ALTER TABLE `shipments` comment 'الشحنات'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shipments');
    }
}
