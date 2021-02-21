<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'vin' => $this->faker->regexify('[A-Z0-9._%+-]+[A-Z0-9.-]{11}'),
            'colour' => $this->faker->safeColorName,
            'make' => $this->faker->randomElement($array = array ('Ford', 'Seat', 'Lancia', 'Dacia', 'Lada')),                                   
            'model' => $this->faker->randomElement($array = array ('Focus', 'Leon', 'Delta', 'Sendero', 'Boris')),           
            'price' => $this->faker->randomFloat($nbMaxDecimals = 2, $min = 10000.00, $max = 90000.00)
        ];
    }
}
