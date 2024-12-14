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
        Schema::create('purchase_packages', function (Blueprint $table) {
            $table->id();
            $table->uuid("uuid")->unique();
            $table->foreignId('user_id')->comment("Partner/Distributor id")->constrained()->cascadeOnDelete();
            $table->foreignId('package_id')->constrained();
            $table->double("amount")->default(0);
            $table->dateTime("paid_at")->nullable();
            $table->enum("paid_status",["paid","pending"])->default("pending");
            $table->string("transaction_id")->nullable();
            $table->enum("payment_method",["visa","mastercard","paypal","stripe"])->default("stripe");
            $table->longText("payment_response")->nullable();

            $table->tinyInteger("is_active")->default(1)->comment("1=Active,0=Inactive");
            $table->foreignId('created_by_id')->nullable()->constrained("users");
            $table->foreignId('updated_by_id')->nullable()->constrained("users");
            $table->foreignId('deleted_by_id')->nullable()->constrained("users");
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_packages');
    }
};
