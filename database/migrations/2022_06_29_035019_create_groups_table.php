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
        Schema::create('groups', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->enum('type', [
                'artist-run-center-organisation',
                'artist',
                'curator',
                'collection',
                'website'
            ])->nullable();
            $table->enum('institution_type', [
                'artist-run-center',
                'arts-organisation',
                'arts-institution',
                'university-gallery'
            ])->nullable();            
            $table->enum('art_practice_type', [
                'performance',
                'multidisciplinary'
            ])->nullable();
            $table->string('address')->nullable();
            $table->string('country')->nullable();
            $table->string('mandate')->nullable();
            $table->text('biography')->nullable();
            $table->string('member_of')->nullable();
            $table->string('additional_information_title')->nullable();
            $table->text('additional_information_content')->nullable();
            $table->enum('status', [
                'enabled', 
                'disabled',
                'deleted'
            ])->nullable()
            ->default('enabled');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('groups');
    }
};
