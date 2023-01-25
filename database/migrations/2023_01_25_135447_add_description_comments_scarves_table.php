<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('scarves', function (Blueprint $table)
        {
            $table->text('description_comments')->default(null)->after('description_care');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('scarves', function (Blueprint $table)
        {
            $table->dropColumn('description_comments');
        });
    }
};
