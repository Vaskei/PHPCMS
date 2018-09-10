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

    <!-- Ispisivanje poruke preko sesije -->
    <?php
    if (isset($_SESSION['msg']) && $_SESSION['msg'] != '') {
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }
    ?>

    <?php

    if (isset($_POST['registration'])) {
        if ($_POST['password'] != $_POST['confirmPassword']) {
            $_SESSION['msg'] = '<div class="alert alert-warning text-center alertFadeout"><strong>Lozinke se ne podudaraju.</strong></div>';
            header("Location: ./registration");
        } else {
            var_dump($_POST);
            $username = trim(htmlentities($_POST['username']));
            $password = sha1(trim(htmlentities($_POST['password'])));
            $nickname = trim(htmlentities($_POST['nickname']));

            if (empty($nickname) || strlen($nickname) > 50 || strlen($nickname) < 4) {
                $_SESSION['msg'] = '<div class="alert alert-warning text-center alertFadeout"><strong>Nadimak je obavezan i može sadržavati maksimalno 50 znakova.</strong></div>';
                header("Location: ./registration");
            } elseif (empty($username) || !preg_match("/^[a-zA-Z0-9]{6,50}$/", $username)) {
                $_SESSION['msg'] = '<div class="alert alert-warning text-center alertFadeout"><strong>Korisničko ime mora sadržavati minimalno 6 znakova, maksimalno 50 znakova, koristite samo slova i/ili brojke.</strong></div>';
                header("Location: ./registration");
            } elseif (empty($password) || !preg_match("/^[a-zA-Z0-9]{6,50}$/", $password)) {
                $_SESSION['msg'] = '<div class="alert alert-warning text-center alertFadeout"><strong>Lozinke moraju sadržavati minimalno 6 znakova, maksimalno 50 znakova, koristite samo slova i/ili brojke. Lozinke se moraju podudarati.</strong></div>';
                header("Location: ./registration");
            } else {
                $query = $db->prepare("SELECT * FROM users WHERE user_username=? LIMIT 1");
                $query->bind_param("s", $username);
                if ($query->execute()) {
                    $result = $query->get_result();
                    if (count($result->fetch_array())) {
                        $_SESSION['msg'] = '<div class="alert alert-warning text-center alertFadeout"><strong>Korisnik već postoji u bazi... Odaberite drugo korisničko ime.</strong></div>';
                        header("Location: ./registration");
                    } else {
                        $query = $db->prepare("INSERT INTO users (user_username, user_password, user_nickname) VALUES (?, ?, ?)");
                        $query->bind_param("sss", $username, $password, $nickname);
                        if ($query->execute()) {
                            $_SESSION['msg'] = '<div class="alert alert-success text-center alertFadeout"><strong>Korisnik kreiran.</strong></div>';
                            header("Location: .");
                        } else {
                            $_SESSION['msg'] = '<div class="alert alert-warning text-center alertFadeout"><strong>Nije bilo moguće kreirati korisnika.</strong></div>';
                            header("Location: ./registration");
                        }
                    }
                } else {
                    $_SESSION['msg'] = '<div class="alert alert-warning text-center alertFadeout"><strong>Greška!</strong></div>';
                    header("Location: ./registration");
                }
            }
        }
    }

    ?>

        <div class="card card-register mx-auto mt-5">
            <div class="card-header bg-light">Registracija</div>
            <div class="card-body">
                <form class="form_validation" action="" method="POST" novalidate>
                    <div class="form-group">
                        <label for="nickname">Nadimak</label>
                        <input class="form-control" name="nickname" id="nickname" type="text" aria-describedby="nicknameHelp" placeholder="Unesite nadimak" pattern=".{4,50}" required>
                        <small id="nicknameHelp" class="form-text text-muted">Nadimak će biti prikazan pored Vašeg profila i svima vidljiv (min. 4 znakova, max. 50 znakova).</small>
                        <div class="invalid-feedback">Nadimak je obavezan.</div>
                    </div>
                    <div class="form-group">
                        <label for="username">Korisničko ime</label>
                        <input class="form-control" name="username" id="username" type="text" aria-describedby="usernameHelp" placeholder="Unesite korisničko ime" pattern="^[a-zA-Z0-9]{6,50}$" required>
                        <small id="usernameHelp" class="form-text text-muted">Korisničko ime koristi se za prijavu (min. 6 znakova, max. 50 znakova, koristite samo slova i/ili brojke).</small>
                        <div class="invalid-feedback">Korisničko ime je obavezno.</div>
                    </div>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-md-6">
                                <label for="password">Lozinka</label>
                                <input class="form-control" name="password" id="password" type="password" placeholder="Lozinka" pattern="^[a-zA-Z0-9]{6,50}$" required>
                                <div class="invalid-feedback">Zaporka je obavezna.</div>
                            </div>
                            <div class="col-md-6">
                                <label for="confirmPassword">Ponovite lozinku</label>
                                <input class="form-control" name="confirmPassword" id="confirmPassword" type="password" placeholder="Ponovite lozinku" pattern="^[a-zA-Z0-9]{6,50}$" required>
                                <div class="invalid-feedback">Zaporke moraju biti jednake.</div>
                            </div>
                        </div>
                        <small id="passwordHelp" class="form-text text-muted">Koristite samo slova i/ili brojke (min. 6 znakova, max. 50 znakova).</small>
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
    <script src="./js/custom.js"></script>
</body>

</html>