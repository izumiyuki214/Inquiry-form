<?php

namespace Database\Factories;

use App\Models\Contact;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    protected $model = Contact::class;

    protected function withFaker()
    {
        return \Faker\Factory::create('ja_JP');
    }

    public function definition(): array
    {
        return [
            'category_id' => Category::inRandomOrder()->value('id'),
            'first_name'  => $this->faker->firstName,
            'last_name'   => $this->faker->lastName,
            'gender'      => $this->faker->numberBetween(1, 3),
            'email'       => $this->faker->safeEmail,
            'tel'         => $this->faker->numerify('###########'),
            'address'     => $this->faker->address,
            'building'    => $this->faker->optional()->secondaryAddress,
            'detail'      => $this->faker->realText(50),
        ];
    }
}
