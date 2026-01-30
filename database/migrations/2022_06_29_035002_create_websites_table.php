<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('websites', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_profile_id')->nullable()->index();
            $table->string('type');
            $table->string('title')->nullable();
            $table->text('description')->nullable();
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
        Schema::dropIfExists('websites');
    }
};
