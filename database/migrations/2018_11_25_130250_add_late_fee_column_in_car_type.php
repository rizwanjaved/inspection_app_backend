<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLateFeeColumnInCarType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('car_types', function (Blueprint $table) {
            $table->integer('late_fee')->nullable();
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('car_types', function(Blueprint $table)
        {
            // delete above columns
            $table->dropColumn(array('late_fee'));
        });
    }
}
