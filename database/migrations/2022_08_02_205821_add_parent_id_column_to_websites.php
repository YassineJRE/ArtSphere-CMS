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
        Schema::table('websites', function (Blueprint $table) 
        {
            $table->unsignedBigInteger('parent_id')->nullable()->index();
            $table->string('url')->nullable();
            $table->string('owner')->nullable();
            $table->string('owner_link')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('websites', 'parent_id'))
        {
            Schema::table('websites', function (Blueprint $table) 
            {
                $table->dropColumn('parent_id');
            });
        }
        if (Schema::hasColumn('websites', 'url'))
        {
            Schema::table('websites', function (Blueprint $table) 
            {
                $table->dropColumn('url');
            });
        }
        if (Schema::hasColumn('websites', 'owner'))
        {
            Schema::table('websites', function (Blueprint $table) 
            {
                $table->dropColumn('owner');
            });
        }
        if (Schema::hasColumn('websites', 'owner_link'))
        {
            Schema::table('websites', function (Blueprint $table) 
            {
                $table->dropColumn('owner_link');
            });
        }
    }
};
