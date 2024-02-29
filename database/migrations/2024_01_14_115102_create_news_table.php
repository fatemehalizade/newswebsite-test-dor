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
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string("code",100);
            $table->string("image")->nullable();
            $table->string("title");
            $table->string("slug");
            $table->foreignId("category_id")->unsigned()->references("id")->on("categories");
            $table->foreignId("user_id")->unsigned()->references("id")->on("users");
            $table->string("summary");
            $table->text("description");
            $table->bigInteger("views")->unsigned()->default(0);
            $table->date("published_at");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};
