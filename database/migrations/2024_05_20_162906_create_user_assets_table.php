<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function Ramsey\Uuid\v1;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_assets', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            $table->integer('total_products')->default(0)->comment("Ex. each QR Code is a product.");
            $table->integer('total_users')->default(0);
            $table->integer('total_models')->default(0);
            $table->boolean('anti_fake_detection')->default(true);
            $table->boolean('create_import_qr')->default(true);
            $table->boolean('fake_detection_alert')->default(true);
            $table->boolean('product_sold_alert')->default(true);
            $table->boolean('out_stock_notifications')->default(true);
            $table->boolean('permissions_system')->default(true);
            $table->boolean('advanced_analytics_system')->default(true);
            $table->boolean('stores_listing')->default(true);
            $table->boolean('managers_dashboard')->default(true);
            $table->boolean('unlimited_lotteries')->default(true);
            $table->boolean('consumers_database_collector')->default(true);
            $table->integer('ordering')->default(0);
            $table->string('image_path')->nullable();
            // Package Features End
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_assets');
    }
};
