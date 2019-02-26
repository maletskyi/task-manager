<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Entities\Task;
use Doctrine\ORM\Tools\Pagination\Paginator;

interface TaskRepositoryInterface
{
    public function getById(int $id): ?Task;

    public function getPage(int $pageNum, int $pageSize, string $order, string $destination): Paginator;

    public function create(Task $task): bool;

    public function save(Task $task): bool;
}