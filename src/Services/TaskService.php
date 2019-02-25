<?php

declare(strict_types=1);

namespace App\Services;

use App\Entities\Task;
use App\Repositories\TaskRepositoryInterface;
use Doctrine\ORM\Tools\Pagination\Paginator;

class TaskService implements TaskServiceInterface
{
    private $taskRepository;

    public function __construct(TaskRepositoryInterface $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function getAllTasks()
    {
        return $this->taskRepository->getAll();
    }

    public function getTasksPage(int $pageNum, int $pageSize, string $order, string $destination = 'asc'): Paginator
    {
        return $this->taskRepository->getPage($pageNum, $pageSize, $order, $destination);
    }

    public function approveTask()
    {
        dump('approve task');
    }

    public function rejectTask()
    {

    }

    public function createTask(Task $task): bool
    {
        return $this->taskRepository->create($task);
    }
}