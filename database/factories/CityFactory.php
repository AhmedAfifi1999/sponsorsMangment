<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\Country;
use Illuminate\Database\Eloquent\Factories\Factory;

class CityFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = City::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $country = Country::inRandomOrder()->limit(1)->first();
        return [
            'name' => $this->faker->city,
            'country_id' => $country->count() > 0 ? $country->id : null
        ];
    }
}
