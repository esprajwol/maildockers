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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->cascadeOnDelete();
            $table->unsignedBigInteger('partner_id')->nullable(); //->constrained("users")->cascadeOnDelete();
            $table->foreignId('country_id')->nullable()->constrained();

            $table->double("payable_amount")->default(0)->comment("Ex. Payable Amount : 9.90");
            $table->double("paid_amount")->default(0)->comment("Ex. 9");
            $table->integer("total_messages")->default(0);
            $table->string("pdf_filepath")->nullable()->comment("Ex. pdf file path");
            $table->tinyInteger('platform_type')->default(1)->comment(platformInside());

            $table->string('from_email')->nullable();
            $table->string('recipient_email')->nullable();
            $table->string('keyword')->nullable();
            $table->string('exclude_keyword')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();

            $table->tinyInteger("is_paid")->default(0)->comment("1=Paid,0=Un-Paid");
            $table->string("payment_gateway")->nullable()->comment("ex. stripe/paypal/cod/payTm");
            $table->longText("transaction_payloads")->nullable()->comment("transaction_payloads of gateway");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
