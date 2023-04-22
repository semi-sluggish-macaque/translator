<?php
//
//namespace Database\Factories;
//
//use Illuminate\Database\Eloquent\Factories\Factory;
//
///**
// * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
// */
//class PostFactory extends Factory
//{
//    /**
//     * Define the model's default state.
//     *
//     * @return array<string, mixed>
//     */
//    public function definition()
//    {
//        return [
//            'title' => fake()->words(3, true),
//            'content' => fake()->paragraph(1),
//            'created_at' => fake()->dateTime(),
//            'updated_at' => fake()->dateTime(),
//            'rubric_id' => fake()->numberBetween(1, 5),
//        ];
//    }
//}


namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition()
    {
        return [
            'title' => fake()->words(3, true),
            'content' => fake()->paragraph(1),
            'created_at' => fake()->dateTime(),
            'updated_at' => fake()->dateTime(),
            'rubric_id' => fake()->numberBetween(1, 5),
        ];
    }
}
