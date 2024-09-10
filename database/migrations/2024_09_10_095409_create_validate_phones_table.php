<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    public function up(){
        Schema::create('validate_phones', function (Blueprint $table) {
            $table->id();
            $table->string('phone');
            $table->integer('code');
            $table->string('status')->default('true');
            $table->timestamps();
        });
    }
    public function down(){
        Schema::dropIfExists('validate_phones');
    }
};
