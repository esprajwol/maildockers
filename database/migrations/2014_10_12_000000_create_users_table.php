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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parent_user_id')->nullable()->constrained("users")->cascadeOnDelete();
            $table->integer("menu_permission_version")->default(0);
            $table->unsignedBigInteger('package_id')->nullable()->comment("Current package id of packages table.");
            $table->unsignedBigInteger('country_id')->nullable();
            $table->string("first_name");
            $table->string("middle_name")->nullable();
            $table->string("last_name")->nullable();

            $table->string('username')->unique();
            $table->enum('user_type',["admin","partner","partner_staff","customer","admin_staff", "client", "individual"])->default("admin")->comment("Ex. admin/partner/customer/staff etc");

            $table->string('photo')->nullable();
            $table->string('email')->nullable();
            $table->string('password');

            $table->string("provider_type")->nullable()->comment("Ex. Gmail/Outlook");
            $table->string("provider_id")->nullable()->comment("Ex. 123");


            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();

            $table->tinyInteger("is_active")->default(1);

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
