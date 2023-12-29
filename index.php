<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Forumify</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</head>

<body style="background-color: #EEF5FF;">
    <?php require 'partials/_dbconnect.php'; ?>
    <?php require 'partials/_header.php'; ?>
    <?php require 'partials/_carousel.php'; ?>

    <!-- Category container starts here -->
    <div class=" container my-5" ">
        <h2 class=" text-center">Forumify - Browse Categories</h2>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 my-4 mx-5">
            <?php
            $sql = "SELECT * FROM `categories`";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
                $categoryId = $row['category_id'];
                $categoryName = $row['category_name'];
                $categoryDesc = $row['category_description'];
                echo '<div class="col my-2 text-center mx-auto">
                    <div class="card" style="width: 18rem;">
                        <img src="https:source.unsplash.com/500x400/?coding,' . $categoryName . '" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">
                            <a href="/forum/threadList.php?catid=' . $categoryId . '&category=' . $categoryName . '">' . $categoryName . '</a>
                            </h5>
                            <p class="card-text">' . substr($categoryDesc, 0, 150) . ' <strong>...</strong></p>
                            <a href="/forum/threadList.php?catid=' . $categoryId . '&category=' . $categoryName . '" class="btn btn-primary">View Threads</a>
                        </div>
                    </div>
                </div>';
            }
            ?>
        </div>
    </div>

    <?php require 'partials/_footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>