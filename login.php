<?php 
session_start();
if (isset($_SESSION['user'])) header ("Location: .");
?>
<?php require_once "includes/db.php"; ?>
<?php $title = "Prijava"; ?>
<?php ob_start(); ?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!-- FontAwesome 4.7.0 -->
    <link rel="stylesheet" href="css/font-awesome.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/phpcms_login.css">

    <title>
        <?php echo isset($title) ? $title : "Stranica"; ?>
    </title>
</head>

<body>
    <div class="container">
        <div class="card card-login mx-auto mt-5">
            <div class="card-header bg-light">Prijava</div>
            <div class="card-body">
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="username">Korisničko ime</label>
                        <input class="form-control" id="username" type="text" aria-describedby="usernameHelp" placeholder="Korisničko ime"/>
                    </div>
                    <div class="form-group">
                        <label for="password">Lozinka</label>
                        <input class="form-control" id="password" type="password" placeholder="Lozinka"/>
                    </div>
                    <input type="submit" value="Prijava" name="login" class="btn btn-primary btn-block"/>                
                </form>
                <div class="form-row text-center mt-3">
                    <div class="col-md-6">
                        <a class="d-block small" href=".">
                            <i class="fa fa-arrow-left fa-fw"></i>&nbsp;
                            Natrag
                        </a>
                    </div>
                    <div class="col-md-6">
                        <a class="d-block small" href="registration">
                            <i class="fa fa-user-plus fa-fw" aria-hidden="true"></i>&nbsp;
                            Registracija
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="./js/jquery-3.3.1.min.js"></script>
    <script src="./js/popper.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/bootstrap-confirmation.min.js"></script>
</body>

</html>