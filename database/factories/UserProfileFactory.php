<?php

namespace Database\Factories;

use App\Enums\ProfileType;
use App\Enums\Status as EnumStatus;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserProfileFactory extends Factory
{
    /**
     * @var mixed
     */
    protected $model = UserProfile::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'status' => EnumStatus::ENABLED,
            'type' => ProfileType::ARTIST,
            'artist_name' => $this->faker->firstName,
            'other_artist_name' => $this->faker->lastName,
            'pronoun' => $this->faker->randomElement(['he/him', 'she/her', 'they/them']),
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'username' => $this->faker->unique()->userName,
            'email' => $this->faker->unique()->safeEmail,
            'address' => $this->faker->address,
            'country' => $this->faker->country,
            'ethnicity' => $this->faker->word,
            'biography' => $this->faker->paragraph,
            'artist_type' => $this->faker->word,
            'member_of' => $this->faker->company,
            'art_practice_type' => $this->faker->word,
            'additional_information_title' => $this->faker->sentence,
            'additional_information_content' => $this->faker->paragraph,
            'specify_artist_type' => $this->faker->word,
            'specify_art_practice_type' => $this->faker->word,
        ];
    }
}
