<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('visits', function (Blueprint $table) {
            $table->id();
            $table->string("url");
            $table->string("ip");
            $table->string("status")->nullable();
            $table->string("continent")->nullable();
            $table->string("country")->nullable();
            $table->string("region")->nullable();
            $table->string("region_code")->nullable();
            $table->string("city")->nullable();
            $table->string("latitude")->nullable();
            $table->string("longitude")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visits');
    }
};
