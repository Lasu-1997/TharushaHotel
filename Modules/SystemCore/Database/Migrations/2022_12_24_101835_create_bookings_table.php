<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('guest_id')->nullable()->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->string('guest_name')->nullable();
            $table->string('guest_email')->nullable();
            $table->string('guest_phone')->nullable();
            $table->string('id_type')->nullable();
            $table->string('id_number')->nullable();
            $table->foreignId('room_category_id')->references('id')->on('room_categories')->onDelete('cascade');
            $table->dateTime('check_in');
            $table->dateTime('check_out');
            $table->integer('no_of_adults')->default(1);
            $table->integer('no_of_children')->default(0);
            $table->integer('no_of_rooms')->nullable();
            $table->boolean('booking_confirmed')->default(false);
            $table->float('charge')->nullable();
            $table->float('discount')->nullable();
            $table->float('total_to_pay')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('payment_status')->default('pending');
            $table->integer('status')->default(1);//1=pending, 2=approved, 3=declined, 4=cancelled
            $table->boolean('is_deleted')->default(false);
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
        Schema::dropIfExists('bookings');
    }
};
