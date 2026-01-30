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
        Schema::table('exhibits', function (Blueprint $table) 
        {
            $table->string('transferor_type')->nullable();
            $table->unsignedBigInteger('transferor_id')->nullable();
            $table->timestamp('transferred_at')->nullable();
            $table->index(['transferor_type', 'transferor_id'], 'transferor');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('exhibits', 'transferor_type'))
        {
            Schema::table('exhibits', function (Blueprint $table) 
            {
                $table->dropColumn('transferor_type');
            });
        }

        if (Schema::hasColumn('exhibits', 'transferor_id'))
        {
            Schema::table('exhibits', function (Blueprint $table) 
            {
                $table->dropColumn('transferor_id');
            });
        }

        if (Schema::hasColumn('exhibits', 'transferred_at'))
        {
            Schema::table('exhibits', function (Blueprint $table) 
            {
                $table->dropColumn('transferred_at');
            });
        }
    }
};
