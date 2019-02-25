<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Entities\Task;
use App\Services\TaskServiceInterface;
use App\Validation\CreateTaskValidation;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Validation;

class TaskController extends AbstractController
{
    private $taskService;

    public function __construct(TaskServiceInterface $taskService, Session $session)
    {
        parent::__construct($session);

        $this->taskService = $taskService;
    }

    public function index(Request $request): Response
    {
        $pageSize = 3;

        $page = $request->get('page');
        $sort = $request->get('sort');

        if (! in_array($sort, ['username', 'status', 'email'], true)) {
            $sort = 'username';
        }

        $tasksPage = $this->taskService->getTasksPage((int) ($page ?? 1), $pageSize,
            $sort === 'status' ? 'isDone' : $sort);
        $totalPages = (int) ceil($tasksPage->count() / $pageSize);

        if ($page > $totalPages) {
            return $this->view('404', [], 404);
        }

        return $this->view('home', [
            'tasks' => $tasksPage,
            'totalPages' => $totalPages,
            'sort' => $sort,
            'page' => $page,
        ]);
    }

    public function create(): Response
    {
        return $this->view('task/create');
    }

    public function save(Request $request): Response
    {
        $username = $request->get('username');
        $email = $request->get('email');
        $content = $request->get('content');

        $validation = new CreateTaskValidation($request);
        $validation->validate();

        die();

        $task = new Task();
        $task->setUsername($username);
        $task->setContent($content);
        $task->setEmail($email);

        if ($this->taskService->createTask($task)) {
            $this->session->getFlashBag()->add('message', 'New task successfully created');
        } else {
            $this->session->getFlashBag()->add('error', 'Error during creation a new task');
        }

        return new RedirectResponse('/');
    }
}