<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .navbar-nav {
            margin-left: auto;
            margin-right: auto;
        }
        .center-text {
            text-align: center;
        }
        .footer {
            background-color: #f8f9fa;
            padding: 10px 0;
            position: fixed;
            width: 100%;
            bottom: 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="center-text">Buyers guide - Apple proizvodi</h1>
    </div>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Projekt</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container mt-4">
        <h2 class="center-text">Apple proizvodi</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Product / Review</th>
                    <th>Rating</th>
                    <th>Next update</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $xml = simplexml_load_file('users.xml') or die("Error: Cannot create object");
                $users = $xml->user;
                $totalUsers = count($users);
                $usersPerPage = 5;
                $totalPages = ceil($totalUsers / $usersPerPage);

                if (isset($_GET['page']) && is_numeric($_GET['page'])) {
                    $currentPage = (int) $_GET['page'];
                } else {
                    $currentPage = 1;
                }

                if ($currentPage > $totalPages) {
                    $currentPage = $totalPages;
                }

                if ($currentPage < 1) {
                    $currentPage = 1;
                }

                $start = ($currentPage - 1) * $usersPerPage;
                $end = $start + $usersPerPage;

                for ($i = $start; $i < $end && $i < $totalUsers; $i++): ?>
                <tr>
                    <td><a href="<?php echo $users[$i]->video; ?>" target="_blank"><?php echo $users[$i]->product; ?></a></td>
                    <td><?php echo $users[$i]->name; ?></td>
                    <td><?php echo $users[$i]->date; ?></td>
                </tr>
                <?php endfor; ?>
            </tbody>
        </table>
        <nav>
            <ul class="pagination justify-content-center">
                <?php if ($currentPage > 1): ?>
                <li class="page-item"><a class="page-link" href="?page=<?php echo $currentPage - 1; ?>">Previous</a></li>
                <?php endif; ?>
                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <li class="page-item <?php if ($currentPage == $i) echo 'active'; ?>"><a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                <?php endfor; ?>
                <?php if ($currentPage < $totalPages): ?>
                <li class="page-item"><a class="page-link" href="?page=<?php echo $currentPage + 1; ?>">Next</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
    <footer class="footer navbar-light bg-light">
        <div class="container">
            <div class="navbar-nav justify-content-center">
                <a class="nav-link" href="index.php">Ivan Radić</a>
            </div>
        </div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>