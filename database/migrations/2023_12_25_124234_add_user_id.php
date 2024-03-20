<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('order_statuses', function (Blueprint $table) {
            $table->foreignId('warehouse_id') //Ordered_from_id
            ->constrained('warehouses')
            ->cascadeOnDelete()
            ->cascadeOnUpdate();

            $table->foreignId('user_id') //Ordered_by_id
            ->constrained('users')
            ->cascadeOnDelete()
            ->cascadeOnUpdate();

            $table->foreignId('order_id')
            ->constrained('orders')
            ->cascadeOnDelete()
            ->cascadeOnUpdate();

            $table->boolean('status')->nullable(); 
            //null for قيد التحضير 
            //0 for تم الارسال 
            //1 for مستلمة
            $table->boolean('payment_status');
            //0 for غير مدفوع
            //1 for مدفوع




        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('order_statuses', function (Blueprint $table) {
            //
        });
    }
};
