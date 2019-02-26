<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Entities\Task;
use App\Services\TaskServiceInterface;
use App\Validation\CreateTaskValidation;
use App\Validation\TaskValidation;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;

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
        return $this->view('task/create', [
            'old' => $this->session->getFlashBag()->get('old'),
            'errors' => $this->session->getFlashBag()->get('errors')
        ]);
    }

    public function save(Request $request): Response
    {
        $username = $request->get('username');
        $email = $request->get('email');
        $content = $request->get('content');

        $errors = (new TaskValidation($request))->validate();

        if (count($errors) > 0) {
            $this->session->getFlashBag()->set('errors', $errors);

            $this->session->getFlashBag()->set('old', [
                'username' => $username,
                'email' => $email,
                'content' => $content,
            ]);

            return new RedirectResponse('/tasks/create');
        }

        $task = new Task();
        $task->setUsername($username);
        $task->setContent($content);
        $task->setEmail($email);
        $task->setIsDone(false);

        if ($this->taskService->createTask($task)) {
            $this->session->getFlashBag()->add('message', 'New task successfully created');
        } else {
            $this->session->getFlashBag()->add('error', 'Error during creation a new task');
        }

        return new RedirectResponse('/');
    }

    public function edit(Request $request, int $id): Response
    {
        $task = $this->taskService->getTaskById($id);

        if ($task === null) {
            return $this->view('404', [], 404);
        }

        return $this->view('task/edit', [
            'task' => $task,
        ]);
    }

    public function update(Request $request): Response
    {
        $id = $request->get('id');
        $username = $request->get('username');
        $email = $request->get('email');
        $content = $request->get('content');
        $isDone = $request->get('is_done');

        $errors = (new TaskValidation($request))->validate();

        if (count($errors) > 0) {
            $this->session->getFlashBag()->set('errors', $errors);

            $this->session->getFlashBag()->set('old', [
                'username' => $username,
                'email' => $email,
                'content' => $content,
                'is_done' => $isDone,
            ]);

            return new RedirectResponse('/tasks/edit');
        }

        $task = new Task();
        $task->setUsername($username);
        $task->setContent($content);
        $task->setEmail($email);
        $task->setIsDone($isDone ? true : false);

        if ($this->taskService->createTask($task)) {
            $this->session->getFlashBag()->add('message', 'The task successfully updated');
        } else {
            $this->session->getFlashBag()->add('error', 'Error during updating the task');
        }

        return new RedirectResponse('/');
    }
}