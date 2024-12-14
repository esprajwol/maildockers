<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

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
            DB::table('orders')
                ->whereNull('status')
                ->update(['status' => 'Generating']);

            DB::statement("ALTER TABLE orders MODIFY COLUMN status ENUM('Generating', 'Done', 'Downloaded', 'Deleted', 'Failed','Refund') NOT NULL DEFAULT 'Generating'");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("ALTER TABLE orders MODIFY COLUMN status ENUM('Generating', 'Done', 'Downloaded', 'Deleted') NOT NULL DEFAULT 'Generating'");
    }
};
