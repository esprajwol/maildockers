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
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger("is_active")->default(1)->comment("1=Active,0=Inactive");
            $table->string("name");

            $table->foreignId("user_id")->comment("Parent id of staff or admin")->constrained()->cascadeOnDelete();
            $table->foreignId("created_by_id")->nullable()->constrained("users");
            $table->foreignId("updated_by_id")->nullable()->constrained("users");
            $table->softDeletes();
            $table->timestamps();

            $table->unique(["name","user_id"],"idx_role_unique");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};
