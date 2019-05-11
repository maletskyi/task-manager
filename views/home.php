<?php require 'parts/header.php' ?>

    <main role="main" class="container">

        <div class="row">
            <div class="col-sm-12">
                <h1 class="text-center my-4">Task list</h1>
            </div>
        </div>

        <?php foreach ($session->getFlashBag()->get('message', []) as $message): ?>
            <div class="alert alert-success my-3" role="alert">
                <?= $message ?>
            </div>
        <?php endforeach; ?>

        <?php foreach ($session->getFlashBag()->get('error', []) as $message): ?>
            <div class="alert alert-danger my-3" role="alert">
                <?= $message ?>
            </div>
        <?php endforeach; ?>

        <div class="row">
            <div class="col-sm-12">
                <a href="/tasks/create" class="btn btn-primary mb-2">New task</a>
                <p>Sort by:
                    <a href="<?= '?page=' . ($page ?? 1) . '&sort=username' ?>"
                       class="<?= $sort === 'username' || $sort === null ? 'font-weight-bold' : '' ?>">Username</a> |
                    <a href="<?= '?page=' . ($page ?? 1) . '&sort=email' ?>"
                       class="<?= $sort === 'email' ? 'font-weight-bold' : '' ?>">E-mail</a> |
                    <a href="<?= '?page=' . ($page ?? 1) . '&sort=status' ?>"
                       class="<?= $sort === 'status' ? 'font-weight-bold' : '' ?>">Status</a>
                </p>
            </div>
        </div>

        <?php foreach ($tasks as $task): ?>

            <div class="row">
                <div class="col-sm-12">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">
                                Task from <?= $task->getUsername() ?> (<?= $task->getEmail() ?>)
                            </h5>
                            <p class="card-text"><?= $task->getContent() ?></p>
                            <p class="card-text">Done: <?= $task->getIsDone() ? 'true' : 'false' ?></p>
                            <?php if (isAdmin($session)): ?>
                                <a href="/tasks/edit/<?= $task->getId() ?>" class="btn btn-primary">Edit</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

        <?php endforeach; ?>

        <?php if ($totalPages > 1): $pageCounter = 0; ?>
            <nav aria-label="...">
                <ul class="pagination">
                    <li class="page-item <?= $page <= 1 ? 'disabled' : '' ?>">
                        <a class="page-link" href="<?= $page <= 1 ? '#'
                            : '?page=' . ($page - 1) . ($sort ? '&sort=' . $sort : '') ?>">
                            Previous
                        </a>
                    </li>

                    <?php while (++$pageCounter <= $totalPages): ?>
                        <li class="page-item <?= $page === $pageCounter ? 'active' : '' ?>">
                            <a class="page-link"
                               href="<?= $page === $pageCounter ? '#'
                                   : '?page=' . $pageCounter . ($sort ? '&sort=' . $sort : '') ?>">
                                <?= $pageCounter ?>
                            </a>
                        </li>
                    <?php endwhile; ?>

                    <li class="page-item <?= $page >= $totalPages ? 'disabled' : '' ?>">
                        <a class="page-link"
                           href="<?= $page >= $totalPages ? '#'
                               : '?page=' . ($page + 1) . ($sort ? '&sort=' . $sort : '') ?>">
                            Next
                        </a>
                    </li>
                </ul>
            </nav>
        <?php endif; ?>

    </main>

<?php require 'parts/footer.php' ?>