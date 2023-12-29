<?php
session_start();

echo '<nav class="navbar navbar-expand-lg navbar-light" style=" background-color:#B4D4FF;">
    <div class="container-fluid">
        <a class="navbar-brand" href="/forum">Forumify</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/forum">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about.php">About</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Categories
                    </a>
                    <ul class="dropdown-menu">';
$sql = "SELECT category_name, category_id FROM `categories`";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
  echo '<li><a class="dropdown-item" href="threadlist.php?catid=' . $row['category_id'] . '&category=' . $row['category_name'] . '""> ' . $row['category_name'] . '</a></li>';
}

echo '</ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.php">Contact</a>
                </li>
            </ul>';


if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
  echo '<div class="d-flex flex-column flex-lg-row">
 
  <form class="d-flex" action="search.php" method="get">
                    <input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-primary ml-2" type="submit">Search</button>
                </form>
                <div class="d-flex flex-column flex-lg-row align-items-center mt-2 mt-lg-0">
                    <p class="my-0 mx-1"> <strong>Welcome, ' . $_SESSION['useremail'] . '</strong> </p>
                    <a href="partials/_logout.php" class="btn btn-primary ms-2" onClick="showLogoutAlert()">Logout</a>
                </div>';
} else {
  echo  '<div class="d-flex">
  <form class="d-flex me-2">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-primary" type="submit">Search</button>
                </form>
                <div class="my-2 mt-lg-0">
                    <button class="btn btn-primary ms-2" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
                    <button class="btn btn-primary ms-2" data-bs-toggle="modal" data-bs-target="#signupModal">Signup</button>
                </div>';
}

echo '
        </div>
    </div>
</nav>';

include 'partials/_loginmodal.php';
include 'partials/_signupmodal.php';

if (isset($_GET['signupSuccess']) && $_GET['signupSuccess'] == "true") {
  echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
  <strong>Success!</strong> Your account is now created, you can login to your account.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}

if (isset($_GET['signupSuccess']) && $_GET['signupSuccess'] == "false") {
  $error = $_GET['error'];
  echo '<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
    <strong>Error!</strong> ' . $error . '
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}
$currentUrl = $_SERVER['REQUEST_URI'];
$isForumPage = strpos($currentUrl, '/forum/index.php') !== false;
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
  if ($isForumPage) {
    echo '<div class="alert alert-primary alert-dismissible fade show my-0" role="alert">
  <strong>Success!</strong> You are now logged in.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
  }
}
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == false) {
  if (isset($_SESSION['showError'])) {
    $error = $_SESSION['showError'];
    echo '<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
    <strong>Error!</strong> ' . $error . '
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
  }
}

echo '<script>
    function showLogoutAlert() {
        alert("You are now logged out.");
    }
</script>';
