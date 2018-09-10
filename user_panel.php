<?php require_once "includes/db.php"; ?>
<?php $title = "Profil"; ?>
<?php require_once "includes/header.php"; ?>

<?php

if (!isset($_SESSION['id'])) {
    header("Location: ./");
}

$query = "SELECT * FROM site_options";
$result = $db->query($query);
if ($result) {
    $row = $result->fetch_assoc();
    //var_dump($row);
    $siteTitle = trim(htmlentities($row['site_title']));
    $navbarTitle = trim(htmlentities($row['navbar_title']));
    $infoText = trim(htmlentities($row['info_text']));
}

?>

<!-- Navigation -->
<?php require_once "includes/navigation.php"; ?>



<!-- Page Content -->
<div class="container sadrzaj">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-12">

            <!-- Ispisivanje poruke preko sesije -->
            <?php
            //var_dump($_SESSION);
            if (isset($_SESSION['msg']) && $_SESSION['msg'] != '') {
                echo $_SESSION['msg'];
                unset($_SESSION['msg']);
            }
            ?>

            <h1 class="my-4">
                Profil
            </h1>

            <hr>

            <?php

            if (isset($_POST['editProfile'])) {
                //var_dump($_POST);
                $user_id = $_SESSION['id'];
                $user_username = $_SESSION['username'];
                $userNicknameEdit = trim(htmlentities($_POST['nicknameEdit']));

                if (empty($userNicknameEdit) || strlen($userNicknameEdit) > 50 || strlen($userNicknameEdit) < 4) {
                    $_SESSION['msg'] = '<div class="alert alert-warning text-center alertFadeout"><strong>Nadimak je obavezan i može sadržavati maksimalno 50 znakova.</strong></div>';
                    header("Location: ./user_panel");
                } else {
                    $query = $db->prepare('SELECT * FROM users WHERE user_nickname=? and user_id!=? LIMIT 1');
                    $query->bind_param('sd', $userNicknameEdit, $user_id);
                    if ($query->execute()) {
                        $result = $query->get_result();
                        if (count($result->fetch_assoc())) {
                            $_SESSION['msg'] = '<div class="alert alert-warning text-center alertFadeout"><strong>Nadimak je već upisan u bazu. Koristite drugi nadimak.</strong></div>';
                            header("Location: ./user_panel");
                        } else {
                            if ($_POST['passwordEdit'] == "" && $_POST['confirmPasswordEdit'] == "") {
                                $query = $db->prepare("UPDATE users SET user_nickname=? WHERE user_id=?");
                                $query->bind_param("si", $userNicknameEdit, $user_id);
                                if ($query->execute()) {
                                    $_SESSION['msg'] = '<div class="alert alert-success text-center alertFadeout"><strong>Korisnik je uspješno izmijenjen.</strong></div>';
                                    header("Location: ./user_panel");
                                } else {
                                    $_SESSION['msg'] = '<div class="alert alert-warning text-center alertFadeout"><strong>Pogreška s upisivanjem u bazu podataka!</strong></div>';
                                    header("Location: ./user_panel");
                                }
                            } elseif ($_POST['passwordEdit'] == $_POST['confirmPasswordEdit']) {
                                if (empty($_POST['passwordEdit']) || !preg_match("/^[a-zA-Z0-9]{6,50}$/", $_POST['passwordEdit'])) {
                                    $_SESSION['msg'] = '<div class="alert alert-warning text-center alertFadeout"><strong>Lozinke moraju sadržavati minimalno 6 znakova, maksimalno 50 znakova, koristite samo slova i/ili brojke. Lozinke se moraju podudarati.</strong></div>';
                                    header("Location: ./user_panel");
                                } else {
                                    $passwordEdit = sha1(trim(htmlentities($_POST['passwordEdit'])));
                                    $query = $db->prepare("UPDATE users SET user_nickname=?, user_password=? WHERE user_id=?");
                                    $query->bind_param("ssd", $userNicknameEdit, $passwordEdit, $user_id);
                                    if ($query->execute()) {
                                        $_SESSION['msg'] = '<div class="alert alert-success text-center alertFadeout"><strong>Korisnik je uspješno izmijenjen.</strong></div>';
                                        header("Location: ./user_panel");
                                    } else {
                                        $_SESSION['msg'] = '<div class="alert alert-warning text-center alertFadeout"><strong>Pogreška s upisivanjem u bazu podataka!</strong></div>';
                                        header("Location: ./user_panel");
                                    }
                                }
                            } else {
                                $_SESSION['msg'] = '<div class="alert alert-warning text-center alertFadeout"><strong>Lozinke se ne podudaraju!</strong></div>';
                                header("Location: ./user_panel");
                            }
                        }
                    } else {
                        $_SESSION['msg'] = '<div class="alert alert-warning text-center alertFadeout"><strong>Pogreška s upisivanjem u bazu podataka!</strong></div>';
                        header("Location: ./user_panel");
                    }
                }

            } else {
                $user_id = $_SESSION['id'];
                $query = $db->prepare('SELECT * FROM users WHERE user_id=? LIMIT 1');
                $query->bind_param('d', $user_id);
                if ($query->execute()) {
                    $result = $query->get_result();
                    $row = $result->fetch_assoc();
                    $userNickname = $row['user_nickname'];
                    $userName = $row['user_username'];
                    $userRole = $row['user_role'];
                }
            }



            ?>

            <div class="card">
                <div class="card-header text-center">
                    <strong> <u> <?php echo $userNickname; ?> </u> </strong> 
                </div>
                <div class="card-body">
                    <h4 class="card-title">Nadimak: <small class="text-muted"> <?php echo $userNickname; ?> </small> </h4>
                    <h4 class="card-title">Korisničko ime: <small class="text-muted"> <?php echo $userName; ?> </small> </h4>
                    <h4 class="card-title">Vrsta profila: <small class="text-muted"> <?php echo $userRole == "user" ? "Korisnik" : "Administrator"; ?> </small> </h4> 
                </div>
                <div class="card-footer text-muted">
                    <form class="form_validation" action="" method="POST" novalidate>
                        <div class="form-group">
                            <label for="nicknameEdit">Promjena nadimka</label>
                            <input class="form-control" name="nicknameEdit" id="nicknameEdit" type="text" aria-describedby="nicknameHelp" value="<?php echo $userNickname; ?>" pattern=".{4,50}" required>
                            <small id="nicknameHelp" class="form-text text-muted">Nadimak će biti prikazan pored Vašeg profila i svima vidljiv (min. 4 znakova, max. 50 znakova).</small>
                            <div class="invalid-feedback">Nadimak je obavezan (min. 4 znakova, max. 50 znakova).</div>
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <label for="passwordEdit">Promjena lozinke</label>
                                    <input class="form-control" name="passwordEdit" id="passwordEdit" type="password" placeholder="Lozinka" >
                                    <div class="invalid-feedback">Zaporka je obavezna (slova i/ili brojke, min. 6 znakova, max. 50 znakova).</div>
                                </div>
                                <div class="col-md-6">
                                    <label for="confirmPasswordEdit">Ponovite novu lozinku</label>
                                    <input class="form-control" name="confirmPasswordEdit" id="confirmPasswordEdit" type="password" placeholder="Ponovite lozinku" >
                                    <div class="invalid-feedback">Zaporke moraju biti jednake.</div>
                                </div>
                            </div>
                            <small id="passwordHelp" class="form-text text-muted">Koristite samo slova i/ili brojke (min. 6 znakova, max. 50 znakova).</small>
                        </div>
                        <div class="form-group text-center">
                            <input type="submit" value="Uredi" name="editProfile" class="btn btn-primary"/>
                        </div>
                        
                    </form>
                </div>
            </div>

        </div>
    </div>
    <!-- /.row -->

    <br>

</div>
<!-- /.container -->

<?php require_once "includes/footer.php"; ?>

<?php 
echo '<script>
    document.querySelector("#profile").classList.add("active");
</script>';
?>