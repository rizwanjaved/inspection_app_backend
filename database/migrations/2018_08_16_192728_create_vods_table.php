<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vods', function (Blueprint $table) {
            $table->increments('id');
			$table->unsignedInteger('category_id');
			$table->string('title');
			$table->string('year')->nullable();
			$table->string('image')->nullable();
			$table->string('link')->nullable();
			$table->timestamps();
			$table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vods');
    }
}
