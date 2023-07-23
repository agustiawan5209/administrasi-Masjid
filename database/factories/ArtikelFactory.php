<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Artikel>
 */
class ArtikelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $paragraphs = $this->faker->paragraphs(rand(2, 6));
        $title = $this->faker->realText(50);
        $post = $title;
        foreach ($paragraphs as $para) {
            $post .= "<p>{$para}</p>";
        }
        $category = $this->faker->randomElement(['Cat1','Cat2','Cat3']);
        return [
            'foto'=> $this->faker->image('public/storage/artikel/',640,480, null, false),
            'tanggal'=> $this->faker->dateTimeBetween('-1 week', '+1 week'),
            'judul'=> $title,
            'kategori'=> $category,
            'isi'=> $post,
        ];
    }
}
