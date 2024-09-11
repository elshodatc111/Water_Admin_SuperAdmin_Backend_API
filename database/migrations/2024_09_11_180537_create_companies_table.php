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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name')->default('Water');
            $table->string('phone')->default('+998908830450');
            $table->string('addres')->default("Qarshi shaxar");
            $table->string('logo')->default("Image.png");
            $table->string('discriotion')->default("Discription");
            $table->string('price')->default('10000');
            $table->string('work_time')->default('09:00-20:00');
            $table->string('reyting')->default('5.0');
            $table->integer('reyting_count')->default(0);
            $table->string('status')->default('true');
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
        Schema::dropIfExists('companies');
    }
};
