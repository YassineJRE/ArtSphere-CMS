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
        if (!Schema::hasColumn('groups', 'city')) 
        {
            Schema::table('groups', function (Blueprint $table) 
            {
                $table->string('city')->nullable()->after('address');
            });   
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('groups', 'city')) 
        {
            Schema::table('groups', function (Blueprint $table) 
            {
                $table->dropColumn('city');
            });   
        }
    }
};
