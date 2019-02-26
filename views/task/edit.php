<?php require __DIR__ . '/../parts/header.php' ?>

    <main role="main" class="container">
        <div class="row">
            <div class="col-sm-12">
                <h1 class="text-center my-4">Edit task with id <?= $task->getId() ?></h1>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <form action="/tasks/update" method="post">
                    <input type="hidden" name="id" value="<?= $task->getId() ?>">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control <?= isset($errors['username']) ? 'is-invalid' : '' ?>"
                               value="<?= $old['username'] ?? $task->getUsername() ?>"
                               name="username" placeholder="Enter username">
                        <div class="invalid-feedback">
                            <?= $errors['username'] ?? '' ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control <?= isset($errors['email']) ? 'is-invalid' : '' ?>"
                               value="<?= $old['email'] ?? $task->getEmail() ?>"
                               name="email" placeholder="Enter email">
                        <div class="invalid-feedback">
                            <?= $errors['email'] ?? '' ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="content">Enter content</label>
                        <textarea class="form-control <?= isset($errors['content']) ? 'is-invalid' : '' ?>"
                                  name="content" rows="3"
                                  placeholder="Enter content"><?= $old['content'] ?? $task->getContent() ?></textarea>
                        <div class="invalid-feedback">
                            <?= $errors['content'] ?? '' ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input"
                                   type="checkbox" <?= isset($isDone) && $isDone !== null ? 'checked' : '' ?> name="is_done">
                            <label class="form-check-label" for="is_done">Done</label>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </main>

<?php require __DIR__ . '/../parts/footer.php' ?>