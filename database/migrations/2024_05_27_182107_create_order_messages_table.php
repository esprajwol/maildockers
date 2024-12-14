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

        Schema::create('order_messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->index("idx_user_id")->constrained()->cascadeOnDelete();
            $table->foreignId('order_id')->constrained()->cascadeOnDelete();
            $table->longText('bcc')->nullable();
            $table->longText('cc')->nullable();
            $table->string('subject')->nullable();
            $table->longText('message')->nullable();
            $table->longText('optional_1')->nullable();
            $table->longText('optional_2')->nullable();
            $table->longText('optional_3')->nullable();
            $table->dateTime('date_time')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_messages');
    }
};
