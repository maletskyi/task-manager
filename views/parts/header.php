<!doctype html>

<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Task manager</title>
</head>

<body>

<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <a class="navbar-brand" href="/">Task manager</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav ml-auto">

            <?php if (! isAdmin($session)): ?>
                <form class="form-inline mt-2 mt-md-0" method="post" action="login">
                    <input class="form-control mr-sm-2" name="login" type="text" placeholder="Login" aria-label="Login">
                    <input class="form-control mr-sm-2" name="password" type="password" placeholder="Password"
                           aria-label="Password">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Sign in</button>
                </form>
            <?php else: ?>
                <li class="nav-item active">
                    <a class="nav-link" href="logout">Logout</a>
                </li>
            <?php endif; ?>

        </ul>
    </div>
</nav>