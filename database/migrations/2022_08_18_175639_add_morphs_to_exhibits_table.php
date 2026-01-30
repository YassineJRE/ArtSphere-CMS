<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

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
            $table->morphs('owner');
        });

        if (Schema::hasColumn('exhibits', 'owner_type') && Schema::hasColumn('exhibits', 'owner_id'))
        {
            DB::statement(
                "UPDATE exhibits
                SET owner_type = 'App\\\\Models\\\\UserProfile', owner_id = user_profile_id
                WHERE user_profile_id IS NOT NULL;"
            );
            DB::statement(
                "UPDATE exhibits
                SET owner_type = 'App\\\\Models\\\\Group', owner_id = group_id
                WHERE group_id IS NOT NULL;"
            );
        }

        if (Schema::hasColumn('exhibits', 'user_profile_id'))
        {
            Schema::table('exhibits', function (Blueprint $table) 
            {
                $table->dropColumn('user_profile_id');
            });
        }

        if (Schema::hasColumn('exhibits', 'group_id'))
        {
            Schema::table('exhibits', function (Blueprint $table) 
            {
                $table->dropColumn('group_id');
            });
        }

        if (Schema::hasColumn('exhibits', 'gallery_id'))
        {
            Schema::table('exhibits', function (Blueprint $table) 
            {
                $table->dropColumn('gallery_id');
            });
        }

        if (Schema::hasColumn('artworks', 'gallery_id'))
        {
            Schema::table('artworks', function (Blueprint $table) 
            {
                $table->dropColumn('gallery_id');
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
        if (!Schema::hasColumn('exhibits', 'user_profile_id') && !Schema::hasColumn('exhibits', 'group_id'))
        {
            Schema::table('exhibits', function (Blueprint $table) 
            {
                $table->unsignedBigInteger('user_profile_id')->nullable()->index();
                $table->unsignedBigInteger('group_id')->nullable()->index();
            });
        }

        if (Schema::hasColumn('exhibits', 'owner_id'))
        {
            Schema::table('exhibits', function (Blueprint $table) 
            {
                $table->dropMorphs('owner');
            });
        }
    }
};
