<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncomesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incomes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('income_type_id')->comment('نوع الإيراد')->constrained('income_types');
            $table->unsignedInteger('paid')->comment('المدفوع');
            $table->foreignId('person_id')->comment('c')->constrained('persons');
            $table->foreignId('payment_type_id')->comment('نوع الدفع')->constrained('payment_types');
            $table->foreignId('bank_id')->comment('رقم الحساب')->constrained('banks');
            $table->string('notes')->nullable()->comment('ملاحظات');
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
        Schema::dropIfExists('incomes');
    }
}
