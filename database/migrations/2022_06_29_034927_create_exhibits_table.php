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
        Schema::create('exhibits', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_profile_id')->nullable()->index();
            $table->unsignedBigInteger('group_id')->nullable()->index();
            $table->unsignedBigInteger('gallery_id')->nullable()->index();
            $table->string('name')->nullable()->index();
            $table->enum('type', [
                'solo',
                'duo',
                'group',
                'residency'
            ])->nullable()->index();
            $table->text('description')->nullable();
            $table->json('locations')->nullable();
            $table->json('dates')->nullable();
            $table->string('location')->nullable();
            $table->date('upcoming_date')->nullable();
            $table->timestamp('open_at')->nullable();
            $table->text('special_thanks')->nullable();
            $table->text('grant_acknowledgement')->nullable();
            $table->text('other_acknoledgements')->nullable();
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
        Schema::dropIfExists('exhibits');
    }
};
