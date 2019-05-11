<?php require __DIR__ . '/../parts/header.php' ?>

    <main role="main" class="container">
        <div class="row">
            <div class="col-sm-12">
                <h1 class="text-center my-4">New task</h1>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <form action="/tasks/save" method="post">

                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control <?= isset($errors['username']) ? 'is-invalid' : '' ?>"
                               value="<?= $old['username'] ?? '' ?>"
                               name="username" placeholder="Enter username">
                        <div class="invalid-feedback">
                            <?= $errors['username'] ?? '' ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control <?= isset($errors['email']) ? 'is-invalid' : '' ?>"
                               value="<?= $old['email'] ?? '' ?>"
                               name="email" placeholder="Enter email">
                        <div class="invalid-feedback">
                            <?= $errors['email'] ?? '' ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="content">Enter content</label>
                        <textarea class="form-control <?= isset($errors['content']) ? 'is-invalid' : '' ?>"
                                  name="content" rows="3"
                                  placeholder="Enter content"><?= $old['content'] ?? '' ?></textarea>
                        <div class="invalid-feedback">
                            <?= $errors['content'] ?? '' ?>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </main>

<?php require __DIR__ . '/../parts/footer.php' ?>