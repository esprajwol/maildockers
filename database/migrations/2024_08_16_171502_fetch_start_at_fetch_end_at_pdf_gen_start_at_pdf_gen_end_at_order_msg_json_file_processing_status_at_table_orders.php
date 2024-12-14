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
        Schema::table('orders', function (Blueprint $table) {
            $table->dateTime("fetch_start_at")->nullable()->after("id");
            $table->dateTime("fetch_end_at")->nullable()->after("id");
            $table->dateTime("pdf_gen_start_at")->nullable()->after("id");
            $table->dateTime("pdf_gen_end_at")->nullable()->after("id");
            $table->string("msg_json_file")->nullable()->after("id");
            $table->tinyInteger("processing_status")->default(0)->comment("1=Fetching Start, 2=Fetching End, 3=pdf_making_start_at, 4=pdf_making_end_at")->after("id");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(["fetch_start_at", "fetch_end_at", "pdf_gen_start_at", "pdf_gen_end_at", "msg_json_file", "processing_status"]);
        });
    }
};
