<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
			$table->bigInteger('shop_id')->nullable(); //store
            $table->string('name')->nullable();//user
			$table->string('shop_domain')->index()->nullable(); //store
			$table->string('domain')->nullable(); //store
            $table->string('email')->nullable(); //user
            $table->string('password')->nullable(); //user - this field is equalsto store's access token
			$table->string('token')->nullable(); //store
			$table->integer('app_version')->nullable();//store
			$table->string('timezone')->nullable(); //store
			$table->enum('status', ['0', '1'])->nullable()->comment('0 - Inactive, 1 - Active'); //store
			$table->integer('total_install_count')->nullable();//store
			$table->timestamps(); //store
			$table->softDeletes(); //store
			$table->timestamp('uninstalled_at')->nullable(); //store
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
