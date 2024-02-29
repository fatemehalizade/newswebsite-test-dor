<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\GenderTypes;
use App\Enums\DutySystemStatus;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string("code",5);
            $table->string("image")->nullable();
            $table->string("first_name");
            $table->string("last_name");
            $table->integer("nationalcode")->unsigned();
            $table->enum("gender",GenderTypes::All);
            $table->string("mobile",15)->unique();
            $table->string("email")->unique();
            $table->string("username",100);
            $table->string("password");
            $table->foreignId("province_id")->unsigned()->nullable()->references("id")->on("provinces");
            $table->foreignId("city_id")->unsigned()->nullable()->references("id")->on("cities");
            $table->enum("duty_system_status",DutySystemStatus::All)->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
