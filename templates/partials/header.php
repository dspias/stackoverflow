<?php
    $filepath = realpath(dirname(__FILE__));
    include ($filepath.'/../../config/Session.php');
    Session::checkSession();
?>

<?php
  header("Cache-Control: no-cache, must-revalidate");
  header("Pragma: no-cache"); 
  header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
  header("Cache-Control: max-age=2592000");
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="includes/bootstrap/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="includes/bootstrap/css/bootstrap-grid.min.css" type="text/css">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">

    
    <link rel="stylesheet" href="includes/css/app.css" type="text/css">

    <title>welcome to stackoverflow</title>
</head>

<body>

<section id="app">

    <section class="header">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="index.php">stackoverflow</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <?php
                $currentPage = substr( $_SERVER['REQUEST_URI'], 15, strlen($_SERVER['REQUEST_URI'])  );
            ?>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item <?php if($currentPage == "index.php"){?>active <?php } ?>">
                        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                    </li>
                <?php
                // !(isset($_SESSION['login']) && $_SESSION['login'] != '')
                    if (Session::get('LoggedIn')) {
                ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php echo Session::get('username') ?>
                </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="profile.php"><?php echo Session::get('username') ?> profile</a>
                            <div class="dropdown-divider"></div>
                            <?php
                if(isset($_GET['action']) && $_GET['action'] == "logout"){
                        Session::Destroy();
                    }
                ?>
                            <a class="dropdown-item" href="?action=logout">logout</a>
                        </div>
                    </li>

                    <?php if( Session::get('role') == 1 ) { ?>
                    <li class="nav-item <?php if($currentPage == "category.php"){?>active <?php } ?>">
                        
                        <a class="nav-link" href="category.php">Category </a>
                    </li>
                    <?php } ?>

                    <?php if( Session::get('role') == 1 ) { ?>
                    <li class="nav-item <?php if($currentPage == "approval.php"){?>active <?php } ?>">
                        
                        <a class="nav-link" href="approval.php">approval </a>
                    </li>
                    <?php } ?>

                    
                <?php } else{    ?>                    
                    
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">login</a>
                    </li>
                    
                <?php } ?>

                </ul>
                <form class="form-inline my-2 my-lg-0" method="POST" action="">
                    <input class="form-control mr-sm-2" name="search" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>
            </div>
        </nav>

    </section>
