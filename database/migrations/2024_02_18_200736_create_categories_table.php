<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('name')->nullable(false);
            $table->boolean('active')->nullable(false);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
