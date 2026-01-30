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
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->enum('type', [
                'artist',
                'curator',
                'public-collector'
            ]);
            $table->string('artist_name')->nullable();
            $table->string('other_artist_name')->nullable();
            $table->string('pronoun')->nullable();
            $table->string('last_name')->nullable();
            $table->string('first_name')->nullable();
            $table->string('username')->unique()->nullable();
            $table->enum('artist_type', [
                'amateur',
                'student',
                'emerging',
                'professional-artist'
            ])->nullable();
            $table->enum('art_practice_type', [
                'performance',
                'multidisciplinary',
                'other'
            ])->nullable();
            $table->string('email')->nullable();
            $table->string('address')->nullable();
            $table->string('country')->nullable();
            $table->string('ethnicity')->nullable();
            $table->text('biography')->nullable();
            $table->string('member_of')->nullable();
            $table->string('additional_information_title')->nullable();
            $table->text('additional_information_content')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->index('user_id');
            $table->index('type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_profile');
    }
};
