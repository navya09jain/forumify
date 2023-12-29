<!DOCTYPE html>
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

    <?php
    $id = $_GET['catid'];
    $sql = "SELECT * FROM `categories` WHERE category_id=$id";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $catname = $row['category_name'];
        $catdesc = $row['category_description'];
    }
    ?>

    <?php
    $showAlert = false;
    $method = $_SERVER['REQUEST_METHOD'];
    if ($method == 'POST') {
        //insert thread into db
        $th_title = $_POST['title'];
        $th_desc = $_POST['desc'];

        $th_title = str_replace("<", "&lt;", $th_title);
        $th_title = str_replace(">", "&gt;", $th_title);

        $th_desc = str_replace("<", "&lt;", $th_desc);
        $th_desc = str_replace(">", "&gt;", $th_desc);
        $sno = $_POST['sno'];
        $sql = "INSERT INTO `thread` ( `thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `timestamp`) VALUES ('$th_title', '$th_desc', '$id', '$sno', current_timestamp())";
        $result = mysqli_query($conn, $sql);
        $showAlert = true;
    }
    if ($showAlert) {
        require 'partials/_alert.php';
    }
    ?>

    <!-- Category container starts here -->
    <div class=" container my-4">
        <div class=" jumbotron">
            <h1 class="display-4">Welcome to <?php echo $catname; ?> forums</h1>
            <p class="lead"><?php echo $catdesc; ?></p>
            <hr class="my-4">
            <p>Please treat this discussion forum with respect. It’s a shared community resource — a place to share
                skills, knowledge and interests through ongoing conversation.
                These are not hard and fast rules, just aids to the human judgment of our community. Use these
                guidelines to keep this a useful place for civilized public discourse.</p>
        </div>
    </div>
    <!-- Form to start a discussion -->
    <?php
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
        echo '<div class="container">
        <h1> Start a discussion </h1>
        <form action="' . $_SERVER['REQUEST_URI'] . '" method="POST">
            <div class="form-group">
                <label for="exampleInputEmail1">Title</label>
                <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
            </div>
            <input type="hidden" name="sno" value="' . $_SESSION["sno"] . '">
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Elaborate your Concern</label>
                <textarea class="form-control" id="desc" name="desc" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary my-2">Post discussion</button>
        </form>
    </div>';
    } else {
        echo '<div class="container">
        <h1 class="py-2">Start a Discussion </h1>
        <p class="lead">You are not logged in. Please login to be able to start a Discussion.</p>
    </div>';
    }
    ?>

    <!-- Questions to be browsed -->
    <div class="container">
        <h1 class="py-2">Browse Questions </h1>
        <?php
        $results_per_page = 5;
        $sql = "SELECT * FROM `thread` WHERE thread_cat_id=$id";
        $result = mysqli_query($conn, $sql);
        $noResult = true;
        $number_of_result = mysqli_num_rows($result);
        $number_of_page = ceil($number_of_result / $results_per_page);

        // Determine which page number the visitor is currently on
        if (!isset($_GET['page'])) {
            $page = 1;
        } else {
            $page = $_GET['page'];
        }

        // Calculate the starting point for the results on the current page
        $page_first_result = ($page - 1) * $results_per_page;

        // Modify the SQL query to include LIMIT for pagination
        $sql = "SELECT * FROM `thread` WHERE thread_cat_id=$id LIMIT $page_first_result, $results_per_page";
        $result = mysqli_query($conn, $sql);

        while ($row = mysqli_fetch_assoc($result)) {
            $noResult = false;
            $title = $row['thread_title'];
            $desc = $row['thread_desc'];
            $id = $row['thread_id'];
            $thread_time = $row['timestamp'];
            $thread_user_id = $row['thread_user_id'];
            $sql2 = "SELECT user_email FROM `user` WHERE sno='$thread_user_id'";
            $result2 = mysqli_query($conn, $sql2);
            $row2 = mysqli_fetch_assoc($result2);

            echo '<div class="media my-3 align-items-center"> 
            <div class="media-body d-flex">
                <div>
                    <img src="img/user.jpeg" width="30px" class="mr-3" alt="User image">
                    <b class="mr-2">' . $row2['user_email'] . '<i> at ' . $thread_time . '</i></b>
                    <hr>
                    <h5 class="mt-3"><a href="thread.php?threadId=' . $id . '" class="text-dark">' . $title . '</a></h5>
                    <p>' . $desc . '</p>
                </div>
            </div>
        </div>';
        }

        if ($noResult) {
            echo '<div class="jumbotron jumbotron-fluid">
            <div class="container">
              <h1 class="display-4">No Comments Found</h1>
              <p class="lead">Be the first person to ask a question.</p>
            </div>
          </div>';
        }

        // Display pagination links
        for ($page = 1; $page <= $number_of_page; $page++) {
            echo '<a role="button" class="btn btn-primary mb-3" href="/forum/threadList.php?catid=' . $_GET['catid'] . '&category=' . $catname . '&page=' . $page . '" style="margin-right:5px;">' . $page . '</a>';
        }
        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>