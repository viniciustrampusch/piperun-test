<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalendarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calendar', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('status_id');
            $table->dateTime('start_at');
            $table->dateTime('end_at');
            $table->text('description');
            $table->string('customer_name')->nullable();
            $table->string('customer_email')->nullable();
            $table->unsignedBigInteger('requester_id')->nullable();
            $table->unsignedBigInteger('requested_id');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('status_id')->references('id')->on('calendar_status');
            $table->foreign('requester_id')->references('id')->on('users');
            $table->foreign('requested_id')->references('id')->on('users');
            $table->unique('start_at', 'requested_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('calendar');
    }
}
