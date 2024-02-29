<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\BoolStatus;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->text("comment");
            $table->integer("parent_id")->unsigned()->nullable()->default(0);
            $table->string("fullname");
            $table->foreignId("user_id")->nullable()->unsigned()->references("id")->on("users");
            $table->string("email");
            $table->foreignId("news_id")->unsigned()->references("id")->on("news");
            $table->enum("is_show",BoolStatus::All)->default(BoolStatus::no);
            $table->dateTime("show_at")->nullable();
            $table->enum("is_seen",BoolStatus::All)->default(BoolStatus::no);
            $table->enum("admin_reply",BoolStatus::All)->default(BoolStatus::no);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
