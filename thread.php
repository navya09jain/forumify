<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Forumify</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body style="background-color: #EEF5FF;">
    <?php require 'partials/_dbconnect.php'; ?>
    <?php require 'partials/_header.php'; ?>
    <?php
    $id = $_GET['threadId'];
    $sql = "SELECT * FROM `threads` WHERE thread_id=$id";
    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($result)) {
        $title = $row['thread_title'];
        $desc = $row['thread_desc'];
        $thread_user_id = $row['thread_user_id'];

        //Query the users table to find out the name of OP
        $sql2 = "SELECT user_email FROM `users` WHERE sno='$thread_user_id'";
        $result2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_assoc($result2);
        $posted_by = $row2['user_email'];
    }
    ?>
    <?php
    $showAlert = false;
    $method = $_SERVER['REQUEST_METHOD'];
    if ($method == 'POST') {
        //insert into comment db
        $comment = $_POST['comment'];
        $comment = str_replace("<", "&lt;", $comment,);
        $comment = str_replace(">", "&gt;", $comment,);
        $sno = $_POST['sno'];
        $sql = "INSERT INTO `comment` (`comment_content`, `thread_id`, `comment_by`, `comment_time`) VALUES ('$comment', '$id', '$sno', current_timestamp())";
        $result = mysqli_query($conn, $sql);
        $showAlert = true;
    }
    if ($showAlert) {
        require 'partials/_alert.php';
    }
    ?>
    <div class="container my-4">
        <div class="jumbotron">
            <h1 class="display-4"><?php echo $title; ?></h1>
            <p class="lead"><?php echo $desc; ?></p>
            <hr class="my-4">
            <p><b>Posted by: <?php echo $posted_by; ?></b> </p>
            <p>Please treat this discussion forum with respect. It’s a shared community resource — a place to share
                skills, knowledge and interests through ongoing conversation.

                These are not hard and fast rules, just aids to the human judgment of our community. Use these
                guidelines to keep this a useful place for civilized public discourse.</p>

        </div>
    </div>
    <?php
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
        echo '<div class="container">
        <h2>Post a comment</h2>
        <form action="' . $_SERVER['REQUEST_URI'] . '" method="POST">
    <div class="form-group">
        <label for="exampleFormControlTextarea1">Type your comment</label>
        <textarea class="form-control my-3" id="comment" name="comment" rows="3"></textarea>
        <input type="hidden" name="sno" value="' . $_SESSION["sno"] . '">
    </div>
    <button type="submit" class="btn btn-primary my-2">Post Comment</button>
    </form>
    </div>';
    } else {
        echo '<div class="container">
    <h1 class="py-2">Post a Comment</h1>
    <p class="lead">You are not logged in. Please login to be able to post comments.</p>
</div>';
    }
    ?>

    <div class="container">
        <h1 class="py-2">Comments</h1>
        <?php
        $results_per_page = 5;
        $id = $_GET['threadId'];
        $sql = "SELECT * FROM `comment` WHERE thread_id=$id";
        $result = mysqli_query($conn, $sql);
        $noResult = true;
        $number_of_result = mysqli_num_rows($result);
        $number_of_page = ceil($number_of_result / $results_per_page);
        // Determine which page number the visitor is currently on
        if (!isset($_GET['pageno'])) {
            $pageno = 1;
        } else {
            $pageno = $_GET['pageno'];
        }
        // Calculate the starting point for the results on the current page
        $page_first_result = ($pageno - 1) * $results_per_page;

        // Modify the SQL query to include LIMIT for pagination
        $sql = "SELECT * FROM `comment` WHERE thread_id=$id LIMIT $page_first_result, $results_per_page";

        $result = mysqli_query($conn, $sql);

        while ($row = mysqli_fetch_assoc($result)) {
            $noResult = false;
            $id = $row['comment_id'];
            $content = $row['comment_content'];
            $time = $row['comment_time'];
            $thread_user_id = $row['comment_by'];

            $sql2 = "SELECT user_email FROM `users` WHERE sno='$thread_user_id'";
            $result2 = mysqli_query($conn, $sql2);
            $row2 = mysqli_fetch_assoc($result2);

            echo '<div class="media my-3 d-flex align-items-center">
                <img src="img/user.jpeg" width="56px" class="mx-3" alt="User image">
                <div class="media-body">
                    <b class="my-0">' . $row2['user_email'] . ' at  <i> (' . $time . ') </i></b> 
                    <br>
                    <hr class="my-0">
                    <p>' . $content . '</p>
                   
                </div>
            </div>';
        }

        if ($noResult) {
            echo '<div class="jumbotron jumbotron-fluid">
                <div class="container">
                  <h1 class="display-4">No Comments Found</h1>
                  <p class="lead">Be the first person to comment.</p>
                </div>
              </div>';
        }
        // Display pagination links
        for ($pageno = 1; $pageno <= $number_of_page; $pageno++) {
            echo '<a role="button" class="btn btn-primary mb-3" href="/forum/thread.php?threadId=' . $_GET['threadId'] . '&pageno=' . $pageno . '" style="margin-right:5px;">' . $pageno . '</a>';
        }
        ?>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>