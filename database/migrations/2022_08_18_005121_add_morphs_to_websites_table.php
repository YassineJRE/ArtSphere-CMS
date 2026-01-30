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
        Schema::table('websites', function (Blueprint $table) 
        {
            $table->nullableMorphs('owner');
        });

        if (Schema::hasColumn('websites', 'owner_type') && Schema::hasColumn('websites', 'owner_id'))
        {
            DB::statement(
                "UPDATE websites
                SET owner_type = 'App\\\\Models\\\\UserProfile', owner_id = user_profile_id
                WHERE user_profile_id IS NOT NULL;"
            );
            DB::statement(
                "UPDATE websites
                SET owner_type = 'App\\\\Models\\\\Group', owner_id = group_id
                WHERE group_id IS NOT NULL;"
            );
        }

        if (Schema::hasColumn('websites', 'user_profile_id'))
        {
            Schema::table('websites', function (Blueprint $table) 
            {
                $table->dropColumn('user_profile_id');
            });
        }

        if (Schema::hasColumn('websites', 'group_id'))
        {
            Schema::table('websites', function (Blueprint $table) 
            {
                $table->dropColumn('group_id');
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
        if (!Schema::hasColumn('websites', 'user_profile_id') && !Schema::hasColumn('websites', 'group_id'))
        {
            Schema::table('websites', function (Blueprint $table) 
            {
                $table->unsignedBigInteger('user_profile_id')->nullable()->index();
                $table->unsignedBigInteger('group_id')->nullable()->index();
            });
        }

        if (Schema::hasColumn('websites', 'owner_id'))
        {
            Schema::table('websites', function (Blueprint $table) 
            {
                $table->dropMorphs('owner');
            });
        }
    }
};
