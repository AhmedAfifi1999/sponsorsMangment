<?php

namespace Database\Factories;

use App\Models\enterpriseSponsor;
use App\Models\Guaranteed;
use App\Models\Payment;
use App\Models\personalSponsor;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Payment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $personal=personalSponsor::select('id')->inRandomOrder()->first();
        $enterPrise=enterpriseSponsor::select('id')->inRandomOrder()->first();
        $guaranteed=Guaranteed::select('id')->inRandomOrder()->first();
        $now=date('Y-m-d');

        $start_date = '2021-8-31 00:00:00';
        $end_date = '2021-11-01 00:00:00';

        $min = strtotime($start_date);
        $max = strtotime($end_date);

        // Generate random number using above bounds
        $val = rand($min, $max);
        $weeks = rand(1, 52);

        // Convert back to desired date format
        $start = new \DateTime(date('Y-m-d H:i:s', $val));
        $end = $start->modify('+' . $weeks . ' weeks');


        return [
            'bill_id'=>rand(1,10000),
            'enterprise_sponsor_id'=>$enterPrise?$enterPrise:null,
            'personal_sponsor_id'=>$personal?$personal:null,
            'guaranteed_id'=>$guaranteed?$guaranteed:null,
            'start'=>$now,
            'end'=>$end,

        ];
    }
}
