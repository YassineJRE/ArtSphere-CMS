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
        Schema::table('groups', function (Blueprint $table) 
        {
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('groups', 'email'))
        {
            Schema::table('groups', function (Blueprint $table) 
            {
                $table->dropColumn('email');
            });
        }

        if (Schema::hasColumn('groups', 'phone'))
        {
            Schema::table('groups', function (Blueprint $table) 
            {
                $table->dropColumn('phone');
            });
        }
    }
};
