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
        Schema::table('users', function (Blueprint $table) {
            $table->string('pronoun')->nullable()->after('last_name');
            $table->string('ethnicity')->nullable()->after('remember_token');
            $table->string('country')->nullable()->after('remember_token');
            $table->string('city')->nullable()->after('remember_token');
            $table->string('address')->nullable()->after('remember_token');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('pronoun');
            $table->dropColumn('ethnicity');
            $table->dropColumn('country');
            $table->dropColumn('city');
            $table->dropColumn('address');            
        });
    }
};
