<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * @return null
     */
    public function up()
    {
        // If the environment is testing and using SQLite, skip the migration
        if (app()->environment('testing') && config('database.default') === 'sqlite') {
            return;
        }

        DB::statement(
            "ALTER TABLE `groups` MODIFY COLUMN `art_practice_type` ENUM('performance','multidisciplinary','other')
            COLLATE utf8mb4_unicode_ci
            DEFAULT NULL;"
        );
    }

    /**
     * @return null
     */
    public function down()
    {
        if (app()->environment('testing') && config('database.default') === 'sqlite') {
            return;
        }

        DB::statement(
            "ALTER TABLE `groups` MODIFY COLUMN `art_practice_type` ENUM('performance','multidisciplinary')
            COLLATE utf8mb4_unicode_ci
            DEFAULT NULL;"
        );
    }
};
