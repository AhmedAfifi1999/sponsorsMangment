<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\Country;
use App\Models\Neighborhood;
use App\Models\personalSponsor;
use Illuminate\Database\Eloquent\Factories\Factory;

class PersonalSponsorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = personalSponsor::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $city=City::inRandomOrder()->limit(1)->first;
        $country=Country::inRandomOrder()->limit(1)->first;
        $neighborhood=Neighborhood::inRandomOrder()->limit(1)->first;

        return [
            'city_id'=>$city->count() >0?$city->id:null,
            'country_id'=>$country->count() > 0 ? $country->id:null,
            'details'=>$this->faker->text(200),
            'first_name'=>$this->faker->firstName,
            'governorate_id'=>'required',
            'identification_number'=>'required',
            'identification_number_type'=>'required',
            'last_name'=>$this->faker->lastName,
            'nationality_id'=>'required',
            'neighborhood_id'=>$neighborhood->count() > 0 ? $neighborhood->id:null,
            'phone_number'=>$this->faker->phoneNumber,
            'sec_name'=>$this->faker->firstName,
            'third_name'=>$this->faker->firstName,
            'telephone'=>$this->faker->phoneNumber,
            'email' => $this->faker->email,
            'password' => bcrypt('123')

        ];
    }
}
