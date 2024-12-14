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
        Schema::create('user_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->tinyInteger("is_enable_two_factor_authentication")->default(0)->comment("0=No need to verify, 1=Send them verification OTP Through SMS/Email");
            $table->tinyInteger("is_enable_notification")->default(0)->comment("0=No Notification will receive, 1=Notification alert is on");
            $table->tinyInteger("is_enable_sms")->default(0)->comment("1=SMS Verification, 2=Email Verification");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_settings');
    }
};
