<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    public function up(){
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('company_id')->default('NULL');
            $table->string('name');
            $table->string('phone')->unique()->default('NULL');
            $table->string('rol')->default('User');
            $table->string('addres')->default('NULL');
            $table->string('status')->default('true');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }
    public function down(){
        Schema::dropIfExists('users');
    }
};
