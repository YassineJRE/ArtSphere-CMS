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
            $table->unsignedInteger('order_column')->nullable()->index();
        });
        Schema::table('collections', function (Blueprint $table) {
            $table->unsignedInteger('order_column')->nullable()->index();
        });
        Schema::table('collection_items', function (Blueprint $table) {
            $table->unsignedInteger('order_column')->nullable()->index();
        });
        Schema::table('documents', function (Blueprint $table) {
            $table->unsignedInteger('order_column')->nullable()->index();
        });
        Schema::table('websites', function (Blueprint $table) {
            $table->unsignedInteger('order_column')->nullable()->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('exhibits', 'order_column'))
        {
            Schema::table('exhibits', function (Blueprint $table) 
            {
                $table->dropColumn('order_column');
            });
        }
        if (Schema::hasColumn('collections', 'order_column'))
        {
            Schema::table('collections', function (Blueprint $table) 
            {
                $table->dropColumn('order_column');
            });
        }
        if (Schema::hasColumn('collection_items', 'order_column'))
        {
            Schema::table('collection_items', function (Blueprint $table) 
            {
                $table->dropColumn('order_column');
            });
        }
        if (Schema::hasColumn('documents', 'order_column'))
        {
            Schema::table('documents', function (Blueprint $table) 
            {
                $table->dropColumn('order_column');
            });
        }
        if (Schema::hasColumn('websites', 'order_column'))
        {
            Schema::table('websites', function (Blueprint $table) 
            {
                $table->dropColumn('order_column');
            });
        }
    }
};
