<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateShipmentDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipment_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shipment_id')->comment('النقلة')->nullable()->constrained("shipments")->cascadeOnUpdate()->nullOnDelete();
            $table->foreignId('representative_id')->comment('المندوب')->nullable()->constrained("representatives")->cascadeOnUpdate()->nullOnDelete();
            $table->foreignId('client_id')->comment('العميل')->nullable()->constrained("clients")->cascadeOnUpdate()->nullOnDelete();
            $table->unsignedInteger('payload')->comment('الحمولة');
            $table->unsignedInteger('cost')->comment('سعر الطن');
            $table->unsignedInteger('discount')->comment('الخصم');
            $table->unsignedInteger('total')->comment('التكلفة الاجمالية');
            $table->unsignedInteger('paid')->comment('المدفوع');
            $table->unsignedInteger('owed')->default(0)->comment('المتبقى');
            $table->unsignedInteger('transportation')->default(0)->comment('المتبقى');
            $table->text('notes')->nullable()->comment('ملاحظات');
            $table->timestamps();
        });
        DB::statement("ALTER TABLE `shipment_details` comment 'تفاصيل الشحنات'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shipment_details');
    }
}
