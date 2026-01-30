<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * @return null
     */
    public function up()
    {
        // If we are in testing mode with SQLite, we cannot alter ENUM types
        if (app()->environment('testing') && config('database.default') === 'sqlite') {
            // Add the new columns without altering ENUM types
            Schema::table('user_profiles', function (Blueprint $table) {
                $table->string('specify_artist_type')->nullable();
                $table->string('specify_art_practice_type')->nullable();
            });
            Schema::table('groups', function (Blueprint $table) {
                $table->string('specify_art_practice_type')->nullable();
            });
            Schema::table('websites', function (Blueprint $table) {
                $table->string('specify_website_group_type')->nullable();
            });
            return;
        }

        // Else we do the ALTER ENUM
        DB::statement(
            "ALTER TABLE `user_profiles` MODIFY COLUMN `artist_type` ENUM('amateur','student','emerging','professional-artist','other')
            COLLATE utf8mb4_unicode_ci
            DEFAULT NULL;"
        );

        DB::statement(
            "ALTER TABLE `user_profiles` MODIFY COLUMN `art_practice_type` ENUM('contemporary','illustration','installation','multidisciplinary','media','digital','painting','performance','photography','other')
            COLLATE utf8mb4_unicode_ci
            DEFAULT NULL;"
        );

        DB::statement(
            "ALTER TABLE `groups` MODIFY COLUMN `art_practice_type` ENUM('contemporary','illustration','installation','multidisciplinary','media','digital','painting','performance','photography','other')
            COLLATE utf8mb4_unicode_ci
            DEFAULT NULL;"
        );

        Schema::table('user_profiles', function (Blueprint $table) {
            $table->string('specify_artist_type')->nullable();
            $table->string('specify_art_practice_type')->nullable();
        });

        Schema::table('groups', function (Blueprint $table) {
            $table->string('specify_art_practice_type')->nullable();
        });

        Schema::table('websites', function (Blueprint $table) {
            $table->string('specify_website_group_type')->nullable();
        });
    }

    /**
     * @return null
     */
    public function down()
    {
        if (app()->environment('testing') && config('database.default') === 'sqlite') {
            // Delete the columns added in the up method
            Schema::table('websites', function (Blueprint $table) {
                if (Schema::hasColumn('websites', 'specify_website_group_type')) {
                    $table->dropColumn('specify_website_group_type');
                }
            });

            Schema::table('user_profiles', function (Blueprint $table) {
                if (Schema::hasColumn('user_profiles', 'specify_artist_type')) {
                    $table->dropColumn('specify_artist_type');
                }
                if (Schema::hasColumn('user_profiles', 'specify_art_practice_type')) {
                    $table->dropColumn('specify_art_practice_type');
                }
            });

            Schema::table('groups', function (Blueprint $table) {
                if (Schema::hasColumn('groups', 'specify_art_practice_type')) {
                    $table->dropColumn('specify_art_practice_type');
                }
            });

            return;
        }

        // Else revert the ENUM changes
        DB::statement(
            "ALTER TABLE `user_profiles` MODIFY COLUMN `artist_type` ENUM('amateur','student','emerging','professional-artist')
            COLLATE utf8mb4_unicode_ci
            DEFAULT NULL;"
        );

        DB::statement(
            "ALTER TABLE `user_profiles` MODIFY COLUMN `art_practice_type` ENUM('performance','multidisciplinary','other')
            COLLATE utf8mb4_unicode_ci
            DEFAULT NULL;"
        );

        DB::statement(
            "ALTER TABLE `groups` MODIFY COLUMN `art_practice_type` ENUM('performance','multidisciplinary','other')
            COLLATE utf8mb4_unicode_ci
            DEFAULT NULL;"
        );

        Schema::table('websites', function (Blueprint $table) {
            if (Schema::hasColumn('websites', 'specify_website_group_type')) {
                $table->dropColumn('specify_website_group_type');
            }
        });

        Schema::table('user_profiles', function (Blueprint $table) {
            if (Schema::hasColumn('user_profiles', 'specify_artist_type')) {
                $table->dropColumn('specify_artist_type');
            }
            if (Schema::hasColumn('user_profiles', 'specify_art_practice_type')) {
                $table->dropColumn('specify_art_practice_type');
            }
        });

        Schema::table('groups', function (Blueprint $table) {
            if (Schema::hasColumn('groups', 'specify_art_practice_type')) {
                $table->dropColumn('specify_art_practice_type');
            }
        });
    }
};
