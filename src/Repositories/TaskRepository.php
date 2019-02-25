<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Entities\Task;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\Tools\Pagination\Paginator;

class TaskRepository extends EntityRepository implements TaskRepositoryInterface
{
    public function getAll(): array
    {
        return $this->findAll();
    }

    public function getPage(int $pageNum, int $pageSize, string $order, string $destination = 'asc'): Paginator
    {
        $builder = $this
            ->createQueryBuilder('tasks')
            ->select('tasks')
            ->setFirstResult($pageSize * ($pageNum - 1))
            ->setMaxResults($pageSize)
            ->orderBy('tasks.' . $order, $destination);

        return new Paginator($builder);
    }

    public function create(Task $task): bool
    {
        try {
            $this->getEntityManager()->persist($task);
            $this->getEntityManager()->flush();
            return true;
        } catch (ORMException $exception) {
            return true;
        }
    }
}