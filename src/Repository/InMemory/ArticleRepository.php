<?php

namespace App\Repository\InMemory;

use App\Entity\Articles;
use App\Repository\ArticleRepositoryInterface;
use Faker\Generator as Faker;

class ArticleRepository implements ArticleRepositoryInterface
{
    /** @var array<int, Articles> */
    private $articles = [];

    public function __construct(private Faker $faker)
    {
        $max = rand(10, 20);
        for ($i = 0; $i < $max; $i++) {
            $this->articles[] = new Articles(
                $this->faker->uuid,
                $this->faker->sentence,
                $this->faker->paragraph,
                $created = $this->faker->dateTimeThisMonth,
                rand(0,100) < 50 ? null : $this->faker->dateTimeBetween($created)
            );
        }
    }

    /**
     * @return iterable<Articles>
     */
    public function getAll(): iterable
    {
        foreach ($this->articles as $article) {
            yield $article;
        }
    }
}