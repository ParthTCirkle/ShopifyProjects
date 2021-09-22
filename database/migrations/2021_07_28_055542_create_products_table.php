<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->nullable();
            $table->bigInteger('product_id')->nullable();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->string('vendor')->nullable();
            $table->string('type')->nullable();
            $table->timestamp('product_created_at')->nullable();
            $table->timestamp('product_updated_at')->nullable();
            $table->string('handle')->nullable();
            $table->enum('status', ['1', '2', '3'])->nullable()->comment('1 - Active, 2 - Archived, 3 - Draft');
            // $table->string('status')->nullable();
            $table->text('tags')->nullable();
            $table->text('image')->nullable();
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
        Schema::dropIfExists('products');
    }
}
