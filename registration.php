<?php 
session_start();
if (isset($_SESSION['user'])) header ("Location: .");
?>
<?php require_once "includes/db.php"; ?>
<?php $title = "Registracija"; ?>
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
        <div class="card card-register mx-auto mt-5">
            <div class="card-header bg-light">Registracija</div>
            <div class="card-body">
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="nickname">Nadimak</label>
                        <input class="form-control" id="nickname" type="text" aria-describedby="nicknameHelp" placeholder="Unesite nadimak">
                        <small id="nicknameHelp" class="form-text text-muted">Nadimak će biti prikazan pored Vašeg profila i svima vidljiv.</small>
                    </div>
                    <div class="form-group">
                        <label for="username">Korisničko ime</label>
                        <input class="form-control" id="username" type="text" aria-describedby="usernameHelp" placeholder="Unesite korisničko ime">
                        <small id="usernameHelp" class="form-text text-muted">Korisničko ime koristi se za prijavu.</small>
                    </div>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-md-6">
                                <label for="password">Lozinka</label>
                                <input class="form-control" id="password" type="password" placeholder="Lozinka">
                            </div>
                            <div class="col-md-6">
                                <label for="confirmPassword">Ponovite lozinku</label>
                                <input class="form-control" id="confirmPassword" type="password" placeholder="Ponovite lozinku">
                            </div>
                        </div>
                    </div>
                    <input type="submit" value="Registracija" name="registration" class="btn btn-primary btn-block"/>
                </form>
                <div class="form-row text-center mt-3">
                    <div class="col-md-6">
                        <a class="d-block small" href=".">
                            <i class="fa fa-arrow-left fa-fw"></i>&nbsp;
                            Natrag
                        </a>
                    </div>
                    <div class="col-md-6">
                        <a class="d-block small" href="login">
                            <i class="fa fa-sign-in fa-fw" aria-hidden="true"></i>&nbsp;
                            Prijava
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