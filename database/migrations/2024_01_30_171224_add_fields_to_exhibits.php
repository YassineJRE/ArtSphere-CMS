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
        Schema::table('exhibits', function (Blueprint $table) {
            $table->timestamp('verified_at')->nullable(); // Auto-generate current timestamp on insert
            $table->bigInteger('verifier_id')->nullable(false); // Not nullable
            $table->enum('verified_status', ['Pending', 'Approved', 'Denied'])->default('Pending');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('exhibits', function (Blueprint $table) {
            $table->dropColumn('verified_at');
            $table->dropColumn('verifier_id');
            $table->dropColumn('verified_status');
        });
    }
};
