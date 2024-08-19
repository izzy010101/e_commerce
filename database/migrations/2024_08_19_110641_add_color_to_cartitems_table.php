<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('cartitems', function (Blueprint $table) {
            $table->string('color')->nullable()->after('product_id');
        });
    }

    public function down()
    {
        Schema::table('cartitems', function (Blueprint $table) {
            $table->dropColumn('color');
        });
    }
};
