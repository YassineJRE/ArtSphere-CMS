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
        Schema::table('artworks', function (Blueprint $table) 
        {
            $table->float('size_lenght', 8, 2)->nullable();
            $table->float('size_width', 8, 2)->nullable();
            $table->float('size_height', 8, 2)->nullable();
            $table->string('video_url')->nullable();
            $table->string('photographer_link')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('artworks', 'size_lenght'))
        {
            Schema::table('artworks', function (Blueprint $table) 
            {
                $table->dropColumn('size_lenght');
            });
        }
        if (Schema::hasColumn('artworks', 'size_width'))
        {
            Schema::table('artworks', function (Blueprint $table) 
            {
                $table->dropColumn('size_width');
            });
        }
        if (Schema::hasColumn('artworks', 'size_height'))
        {
            Schema::table('artworks', function (Blueprint $table) 
            {
                $table->dropColumn('size_height');
            });
        }
        if (Schema::hasColumn('artworks', 'video_url'))
        {
            Schema::table('artworks', function (Blueprint $table) 
            {
                $table->dropColumn('video_url');
            });
        }
        if (Schema::hasColumn('artworks', 'photographer_link'))
        {
            Schema::table('artworks', function (Blueprint $table) 
            {
                $table->dropColumn('photographer_link');
            });
        }
    }
};
