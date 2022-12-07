<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('coupon', 12)->comment('رقم الكوبون');
            $table->foreignId('manufactory_id')->comment('المصنع')->nullable()->constrained("manufactories")->cascadeOnUpdate()->nullOnDelete();
            $table->foreignId('transportation_id')->comment('شركة النقل')->nullable()->constrained("transportations")->cascadeOnUpdate()->nullOnDelete();
            $table->foreignId('shipment_id')->comment('الشحنة')->nullable()->constrained("shipments")->cascadeOnUpdate()->nullOnDelete();
            $table->foreignId('cement_type_id')->comment('نوع الأسمنت')->nullable()->constrained("cement_types")->cascadeOnUpdate()->nullOnDelete();
            $table->tinyInteger('value')->comment('قيمة الكوبون');
            $table->unsignedInteger('cost')->comment('التكلفة');
            $table->boolean('used')->default(0)->comment('استخدم');
            $table->boolean('packed')->default(1)->comment('معبأ');
            $table->text('notes')->nullable()->comment('ملاحظات');
            $table->timestamps();
        });
        DB::statement("ALTER TABLE `coupons` comment 'الكوبونات'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coupons');
    }
}
