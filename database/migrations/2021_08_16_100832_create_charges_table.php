<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChargesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('charges', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('plan_id')->nullable();
            $table->bigInteger('charge_id')->nullable();
            $table->string('name')->nullable();
            $table->integer('price')->nullable();
            $table->integer('trial_days')->nullable();
            $table->enum('status', ['1', '2', '3', '4', '5'])->nullable()->comment('1 - Active, 2 - Declined, 3 - Expired, 4 - Frozen, 5 - Cancelled');
            // $table->string('status')->nullable();
            $table->string('test')->nullable();
            $table->timestamp('billing_on')->nullable();
            $table->timestamp('activated_on')->nullable();
            $table->timestamp('cancelled_on')->nullable();
            $table->timestamp('trial_ends_on')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('plan_id')->references('id')->on('plans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('charges');
    }
}
