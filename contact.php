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
    $method = $_SERVER['REQUEST_METHOD'];
    if ($method == "POST") {
        $name = $_POST["contactName"];
        $email = $_POST["contactEmail"];
        $concern = $_POST["concern"];

        $sql = "INSERT INTO `contactus` ( `name`, `email`, `concern`, `datetime`) VALUES ( '$name', '$email', '$concern', current_timestamp())";
        $result = mysqli_query($conn, $sql);
    }
    ?>


    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1 class="display-4">Contact Us</h1>
            <p class="lead">We'd Love to Hear From You! <br />
                Have a question, suggestion, or just want to say hello? We're here for you! <br />
                You can use the form below to send us a message. We'll get back to you as soon as possible! <br />
            </p>
        </div>
    </div>



    <div class="container">
        <form action="/forum/contact.php" method="POST">
            <div class="form-group mb-4">
                <label for="exampleFormControlInput1">Name</label>
                <input type="text" class="form-control" id="contactName" name="contactName" placeholder="Enter your name here" />
            </div>
            <div class="form-group mb-4">
                <label for="exampleFormControlInput1">Email address</label>
                <input type="email" class="form-control" id="contactEmail" name="contactEmail" placeholder="name@example.com" />
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                    else.</small>
            </div>

            <div class="form-group">
                <label for="exampleFormControlTextarea1">Elaborate your concern</label>
                <textarea class="form-control" id="concern" name="concern" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary mt-2" name="submit">Submit</button>
        </form>
        <div class="jumbotron jumbotron-fluid">
            <div class="container">

                <p class="lead mt-3">Thank you for reaching out to us! We appreciate your interest and look forward to
                    connecting with you. <br />
                    Best Regards,<br />
                    Forumify.
                </p>
            </div>
        </div>
    </div>

    <?php require 'partials/_footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>