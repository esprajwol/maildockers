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
        Schema::create('partners', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained()->cascadeOnDelete();
            $table->foreignId("tenant_id")->nullable()->constrained();
            $table->string("affiliation_id")->unique();
            $table->string("company_name")->nullable();
            $table->string("company_logo")->nullable();
            $table->text("office_address")->nullable();
            $table->text("company_description")->nullable();
            $table->string("contact_full_name")->nullable();
            $table->string("contact_title")->nullable();
            $table->string("contact_email")->nullable();
            $table->string("contact_mobile_number")->nullable();
            $table->string("account_name")->nullable();
            $table->string("account_iban")->nullable();
            $table->string("account_swift")->nullable();
            $table->string("vat_number")->nullable();

            $table->string("facebook_link")->nullable();
            $table->string("instagram_link")->nullable();
            $table->string("tiktok_link")->nullable();
            $table->string("youtube_link")->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partners');
    }
};
