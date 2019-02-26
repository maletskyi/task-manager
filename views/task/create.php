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
                        <input type="text" class="form-control" name="username" placeholder="Enter username">
                    </div>

                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control" name="email" placeholder="Enter email">
                    </div>

                    <div class="form-group">
                        <label for="content">Enter content</label>
                        <textarea class="form-control" name="content" rows="3" placeholder="Enter content"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </main>

<?php require __DIR__ . '/../parts/footer.php' ?>