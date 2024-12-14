<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('company_email')->nullable();
            $table->string('company_name')->nullable();
            $table->string('company_no')->nullable();
            $table->string('company_website')->nullable();
            $table->string('company_address')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(["company_email"]);
            $table->dropColumn(["company_name"]);
            $table->dropColumn(["company_no"]);
            $table->dropColumn(["company_website"]);
            $table->dropColumn(["company_address"]);
        });
    }
};
