<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('expense_type_id')->comment('نوع المصروف')->nullable()->constrained("expense_types")->cascadeOnUpdate()->nullOnDelete();
            $table->unsignedInteger('paid')->comment('المدفوع');
            $table->foreignId('person_id')->comment('المستفيد')->nullable()->constrained("persons")->cascadeOnUpdate()->nullOnDelete();
            $table->foreignId('company_id')->comment('الشركة')->nullable()->constrained("companies")->cascadeOnUpdate()->cascadeOnDelete();
            $table->text('notes')->nullable()->comment('ملاحظات');
            $table->timestamps();
        });
        DB::statement("ALTER TABLE `expenses` comment 'المصروفات'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('expenses');
    }
}
