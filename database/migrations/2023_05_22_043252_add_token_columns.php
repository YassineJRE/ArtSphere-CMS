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
        Schema::table('exhibits', function (Blueprint $table) 
        {
            $table->string('token')->nullable()->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('exhibits', 'token'))
        {
            Schema::table('exhibits', function (Blueprint $table) 
            {
                $table->dropColumn('token');
            });
        }
    }
};
