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
        Schema::create('message_archives', function (Blueprint $table) {
            $table->id();
            $table->string("purpose")->default("otp")->comment("Ex. Login OTP/Order Scan/Lottery Notification");
            $table->string("to_number");
            $table->string("from_number");
            $table->string("otp")->nullable();
            $table->longText("body")->nullable();
            $table->string("sms_provider")->default("twilio")->comment("ex. twilio");

            $table->foreignId('created_by_id')->nullable()->constrained("users");
            $table->foreignId('updated_by_id')->nullable()->constrained("users");
            $table->foreignId('deleted_by_id')->nullable()->constrained("users");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('message_archives');
    }
};
