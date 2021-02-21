<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Customer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            
        'email' => $this->faker->unique()->safeEmail,
        'forename' => $this->faker->firstName,
        'surname' => $this->faker->lastName                                  ,
        'contact_number' => $this->faker->phoneNumber             ,
        'postcode' => $this->faker->postcode                            ,
        ];
    }
}
