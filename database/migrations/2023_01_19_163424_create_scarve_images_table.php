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
        Schema::create('scarves_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('scarves_id')->default(null)->nullable(true);
            $table->string('name', 255);
            $table->string('original_name', 255);
            $table->string('path', 255);
            $table->boolean('main_image')->default(false);
            $table->foreign('scarves_id')->references('id')->on('scarves')->nullOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('scarves_images');
    }
};
