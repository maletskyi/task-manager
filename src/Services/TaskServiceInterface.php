<?php

declare(strict_types=1);

namespace App\Services;

use App\Entities\Task;
use Doctrine\ORM\Tools\Pagination\Paginator;

interface TaskServiceInterface
{
    public function getAllTasks();

    public function getTasksPage(int $pageNum, int $pageSize, string $order, string $destination): Paginator;

    public function approveTask();

    public function rejectTask();

    public function createTask(Task $task): bool;
}