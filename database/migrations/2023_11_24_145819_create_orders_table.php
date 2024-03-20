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
            Schema::create('orders', function (Blueprint $table) {
            $table->id();

            $table->foreignId('warehouse_id') //Ordered_from_id
                    ->constrained('warehouses')
                    ->cascadeOnDelete()
                    ->cascadeOnUpdate();

            $table->boolean('order_status'); // 0 for opened order and 1 for delivered order  

          //  $table->foreignId('order_status_id')
            //        ->constrained('order_statuses')
              //      ->cascadeOnDelete()
                //    ->cascadeOnUpdate();

            $table->foreignId('user_id') //Ordered_by_id
                    ->constrained('users')
                    ->cascadeOnDelete()
                    ->cascadeOnUpdate();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
