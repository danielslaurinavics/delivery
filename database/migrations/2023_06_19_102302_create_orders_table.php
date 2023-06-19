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
			$table->dateTime('ordered_at')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->unsignedBigInteger('ordered_by');
			$table->foreign('ordered_by')->references('id')->on('users')->onDelete('CASCADE');
			$table->unsignedBigInteger('made_by');
			$table->foreign('made_by')->references('id')->on('restaurants')->onDelete('CASCADE');
			$table->unsignedBigInteger('dish_id');
			$table->foreign('dish_id')->references('id')->on('dishes')->onDelete('CASCADE');
			$table->unsignedBigInteger('courier_id');
			$table->foreign('courier_id')->references('id')->on('users')->onDelete('CASCADE');
			$table->string('status');
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
