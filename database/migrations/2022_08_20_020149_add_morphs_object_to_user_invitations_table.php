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
        Schema::table('user_invitations', function (Blueprint $table) 
        {
            $table->morphs('subject');
        });

        if (Schema::hasColumn('user_invitations', 'subject_type') && Schema::hasColumn('user_invitations', 'subject_id'))
        {
            DB::statement(
                "UPDATE user_invitations
                SET subject_type = 'App\\\\Models\\\\Group', subject_id = group_id
                WHERE group_id IS NOT NULL;"
            );
        }

        if (Schema::hasColumn('user_invitations', 'group_id'))
        {
            Schema::table('user_invitations', function (Blueprint $table) 
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
        if (!Schema::hasColumn('user_invitations', 'group_id'))
        {
            Schema::table('user_invitations', function (Blueprint $table) 
            {
                $table->unsignedBigInteger('group_id')->nullable()->index();
            });
        }

        if (Schema::hasColumn('user_invitations', 'subject_id'))
        {
            Schema::table('user_invitations', function (Blueprint $table) 
            {
                $table->dropMorphs('subject');
            });
        }
    }
};
