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

    <!-- Ispisivanje poruke preko sesije -->
    <?php
    if (isset($_SESSION['msg']) && $_SESSION['msg'] != '') {
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }
    ?>

    <?php

    if (isset($_POST['login'])) {
        $username = trim(htmlentities($_POST['username']));
        $password = sha1(trim(htmlentities($_POST['password'])));

        $query = $db->prepare("SELECT * FROM users WHERE user_username=? LIMIT 1");
        $query->bind_param("s", $username);
        if ($query->execute()) {
            $result = $query->get_result();
            //var_dump($result);
            $row = $result->fetch_assoc();
            //var_dump($row);
            if (!count($row)) {
                $_SESSION['msg'] = '<div class="alert alert-warning text-center alertFadeout"><strong>Korisnik ne postoji u bazi...</strong></div>';
                header("Location: ./login");
            } else {
                if ($row['user_password'] == $password) {
                    //var_dump($_POST);
                    //var_dump($row);
                    $_SESSION['user'] = $row['user_nickname'];
                    $_SESSION['role'] = $row['user_role'];
                    //var_dump($_SESSION);
                    header("Location: .");
                } else {
                    $_SESSION['msg'] = '<div class="alert alert-warning text-center alertFadeout"><strong>Neispravna lozinka!</strong></div>';
                    header("Location: ./login");
                }
            }
        } else {
            $_SESSION['msg'] = '<div class="alert alert-warning text-center alertFadeout"><strong>Greška!</strong></div>';
            header("Location: ./login");
        }
        $db->close();
    }

    ?>

        <div class="card card-login mx-auto mt-5">
            <div class="card-header bg-light">Prijava</div>
            <div class="card-body">
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="username">Korisničko ime</label>
                        <input class="form-control" name="username" id="username" type="text" aria-describedby="usernameHelp" placeholder="Korisničko ime"/>
                    </div>
                    <div class="form-group">
                        <label for="password">Lozinka</label>
                        <input class="form-control" name="password" id="password" type="password" placeholder="Lozinka"/>
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
    <script src="./js/custom.js"></script>
</body>

</html>