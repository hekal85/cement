<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies',  function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('الاسم');
            $table->string('director')->nullable()->comment('المدير');
            $table->string('mobile')->nullable()->comment('الموبايل');
            $table->string('phone')->nullable()->comment('الهاتف');
            $table->string('state_id')->nullable()->comment('المحافظة');
            $table->string('city_id')->nullable()->comment('المركز');
            $table->string('address')->nullable()->comment('العنوان');
            $table->string('email')->nullable()->comment('الإيميل');
            $table->integer('cash')->default(0)->comment('الرصيد');
            $table->text('notes')->nullable()->comment('ملاحظات');
            $table->timestamps();
        });
        DB::statement("ALTER TABLE `companies` comment 'الشركات'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('companies');
    }
}
