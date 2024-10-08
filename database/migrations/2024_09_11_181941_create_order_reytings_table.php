<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_reytings', function (Blueprint $table) {
            $table->id();
            $table->string('company_id');
            $table->string('order_id');
            $table->string('user_id');
            $table->string('currer_id');
            $table->string('comment');
            $table->string('reyting');
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
        Schema::dropIfExists('order_reytings');
    }
};
