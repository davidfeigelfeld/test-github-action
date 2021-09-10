<?php

namespace App\Repository;

use App\Entity\Articles;

interface ArticleRepositoryInterface
{
    /**
     * @return iterable<int, Articles>
     */
    public function getAll(): iterable;
}