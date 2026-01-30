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
        Schema::table('user_profiles', function (Blueprint $table) {
            $table->enum('status', [
                'enabled',
                'disabled',
                'deleted'
            ])->nullable()
            ->default('enabled');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('user_profiles', 'status'))
        {
            Schema::table('user_profiles', function (Blueprint $table) {
                $table->dropColumn('status');
            });
        }
    }
};
