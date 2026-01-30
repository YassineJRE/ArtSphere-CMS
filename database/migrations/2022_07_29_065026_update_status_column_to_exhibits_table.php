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
        if (app()->environment('testing') && config('database.default') === 'sqlite') {
            return; // Ignore migration during tests
        }

        DB::statement(
            "ALTER TABLE `exhibits` MODIFY COLUMN `status` ENUM(
                'enabled',
                'disabled',
                'to-verified-galleries-only',
                'deleted'
            )
            COLLATE utf8mb4_unicode_ci
            DEFAULT 'enabled';"
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
            "ALTER TABLE `exhibits` MODIFY COLUMN `status` ENUM(
                'enabled',
                'disabled',
                'deleted'
            )
            COLLATE utf8mb4_unicode_ci
            DEFAULT 'enabled';"
        );
    }
};
