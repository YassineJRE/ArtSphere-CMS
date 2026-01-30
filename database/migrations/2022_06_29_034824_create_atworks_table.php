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
        Schema::create('artworks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('exhibit_id')->index();
            $table->unsignedBigInteger('gallery_id')->nullable()->index();
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->string('location')->nullable();
            $table->date('date')->nullable();
            $table->text('photographer')->nullable();
            $table->string('medium')->nullable();
            $table->string('size')->nullable();
            $table->text('grant_acknowledgement')->nullable();
            $table->text('other_acknoledgements')->nullable();
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
        Schema::dropIfExists('artworks');
    }
};
