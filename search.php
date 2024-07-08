<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        .container {
            min-height: 90vh;
        }
    </style>

    <title>Forumify</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</head>

<body>
    <?php require 'partials/_dbconnect.php'; ?>
    <?php require 'partials/_header.php'; ?>


    <!--Search Resuts-->
    <div class="container text-center">
        <div class="searchResults">
            <h1 class="my-4">Search results for <em>"<?php echo $_GET['search'] ?>"</em></h1>
            <?php
            $noResults = true;
            $query = $_GET["search"];
            $sql = "SELECT * from `threads` where match (thread_title, thread_desc) against ('$query')";
            $result = mysqli_query($conn, $sql);

            while ($row = mysqli_fetch_assoc($result)) {
                $title = $row['thread_title'];
                $desc = $row['thread_desc'];
                $thread_id = $row['thread_id'];
                $url = "thread.php?threadId=" . $thread_id;
                $noResults = false;
                //Display the search result
                echo '<div class="result">
                 <h3><a href="' . $url . '" class="text-dark"> ' . $title . ' </a></h3>
                 <p>' . $desc . ' </p>
               </div>';
            }
            if ($noResults) {
                echo '<div class="jumbotron jumbotron-fluid">
                <div class="container">
                  <h1 class="display-4">No Results Found</h1>
                  <p class="lead"><u>Suggestions:</u> Make sure that all the words are spelled correctly. Try different keywords. Try more general keywords.</p>
        </div>
    </div>';
            }

            ?>

        </div>
    </div>


    <?php require 'partials/_footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>