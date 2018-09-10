<?php require_once "includes/admin_db.php"; ?>
<?php $title = "Admin - Dodavanje članka"; ?>
<?php require_once "includes/admin_header.php"; ?>

<!-- Navigation -->
<?php require_once "includes/admin_navigation.php"; ?>

<!-- Page Content -->
<div class="container-fluid h-100">
    <div class="row h-100">
        <?php require_once "includes/admin_sidebar.php"; ?>
        <main class="col bg-faded py-3">
            <h2>Dodavanje članka</h2>
            <hr>

            <!-- Ispisivanje poruke preko sesije -->
            <?php
            if (isset($_SESSION['msg']) && $_SESSION['msg'] != '') {
                echo $_SESSION['msg'];
                unset($_SESSION['msg']);
            }
            ?>

            <!-- Dodavanje clanka -->
            <?php
            if (isset($_POST['create_post'])) {
                $post_title = trim(htmlentities($_POST['post_title']));
                $post_author = trim(htmlentities($_POST['post_author']));
                $post_category = trim(htmlentities($_POST['post_category']));
                $post_tags = trim(htmlentities($_POST['post_tags']));
                $post_content = trim(htmlentities($_POST['post_content']));
                //$post_date = date('Y-m-d H:i:s');
                //$post_date_unix = strtotime($post_date);
                //$post_date_page = date('d.m.Y. H:i', $post_date_unix);
                $post_comment_count = 4;

                $allowed_MIME = array("image/jpeg", "image/gif", "image/png", "image/bmp");

                if (empty($post_title) || strlen($post_title) > 255) {
                    $_SESSION['msg'] = '<div class="alert alert-warning text-center alertFadeout"><strong>Naslov članka je obavezan! (Max. 255 znakova)</strong></div>';
                    header("Location: ./add_post");
                } else if (empty($post_category)) {
                    $_SESSION['msg'] = '<div class="alert alert-warning text-center alertFadeout"><strong>Kategorija članka je obavezna!</strong></div>';
                    header("Location: ./add_post");
                } else if (empty($post_author) || strlen($post_author) > 50) {
                    $_SESSION['msg'] = '<div class="alert alert-warning text-center alertFadeout"><strong>Autor članka je obavezan! (Max. 50 znakova)</strong></div>';
                    header("Location: ./add_post");
                } else if (empty($_FILES['post_image']['name'])) {
                    $_SESSION['msg'] = '<div class="alert alert-warning text-center alertFadeout"><strong>Slika je obavezna! (Max. 1MB)</strong></div>';
                    header("Location: ./add_post");
                } else if (!empty($_FILES['post_image']['type'])&&!in_array($_FILES['post_image']['type'], $allowed_MIME)) {
                    $_SESSION['msg'] = '<div class="alert alert-warning text-center alertFadeout"><strong>Niste odabrali ispravan tip datoteke!!! (gif, jpeg, bmp ili png)</strong></div>';
                    header("Location: ./add_post");
                } else if ($_FILES['post_image']['size'] > 1048576) {
                    $_SESSION['msg'] = '<div class="alert alert-warning text-center alertFadeout"><strong>Slika je prevelika! (Max. 1MB)</strong></div>';
                    header("Location: ./add_post");
                } else if (empty($post_tags) || strlen($post_tags) > 255) {
                    $_SESSION['msg'] = '<div class="alert alert-warning text-center alertFadeout"><strong>Tagovi članka su obavezni! Stavite barem jedan tag vezan uz sadržaj članka. (Max. 255 znakova)</strong></div>';
                    header("Location: ./add_post");
                } else if (empty($post_content)) {
                    $_SESSION['msg'] = '<div class="alert alert-warning text-center alertFadeout"><strong>Sadržaj članka je obavezan!</strong></div>';
                    header("Location: ./add_post");
                } else {
                    $post_image_temp = $_FILES['post_image']['tmp_name'];
                    $post_image = basename($_FILES['post_image']['name']);
                    
                    $lastDot = strrpos($post_image, ".");
                    $ext = substr($post_image, $lastDot);
                    $post_image = str_replace(".", "", substr($post_image, 0, $lastDot));
                    $post_image = str_replace(" ", "", $post_image);                    
                    if (strlen($post_image)>50) $post_image = substr($post_image, 0, 50);
                    $post_image.=$ext;
                    
                    $upload_dir = "../images";
					$i = 0;
					while (file_exists($upload_dir . "/" . $post_image)) {
						list ($fileName, $fileExt) = explode(".", $post_image);
						$post_image = rtrim($fileName, strval($i-1)) . $i . "." . $fileExt;
						$i++;
                    }
                    $post_image_move = $upload_dir . "/" . $post_image;
                    //echo "post_image_move " . $post_image_move;
                    //echo "<br />";
                    if (move_uploaded_file($post_image_temp, $post_image_move)) {
                        $query = $db->prepare("INSERT INTO posts (post_category_id, post_title, post_author, post_image, post_content, post_tags, post_comment_count)
                        VALUES (?, ?, ?, ?, ?, ?, ?)");
                        $query->bind_param("isssssi", $post_category, $post_title, $post_author, $post_image, $post_content, $post_tags, $post_comment_count);
                        if ($query->execute()) {
                            $_SESSION['msg'] = '<div class="alert alert-success text-center alertFadeout"><strong>Članak dodan.</strong></div>';
                            header("Location: ./add_post");
                        } else {
                            $_SESSION['msg'] = '<div class="alert alert-warning text-center alertFadeout"><strong>Greška!</strong></div>';
                            header("Location: ./add_post");
                        }
                    } else {
                        $_SESSION['msg'] = '<div class="alert alert-warning text-center alertFadeout"><strong>Pogreška s spremanjem slike!</strong></div>';
                        header("Location: ./add_post");
                    }
                }

                //move_uploaded_file($post_image_temp, "../images/$post_image");

                // echo "var_dump POST: <br />";
                // var_dump($_POST);
                // echo "var_dump FILES: <br />";
                // var_dump($_FILES);
                //echo $post_date;
                // echo "<br />";
                // echo $post_date_unix;
                // echo "<br />";
                // echo $post_date_page;
                // echo "<br />";
                // echo "post_comment_count = " . $post_comment_count;
                // echo "<br />";

                // $query = $db->prepare("INSERT INTO posts (post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_comment_count)
                //                          VALUES (?, ?, ?, NOW(), ?, ?, ?, ?)");
                // $query->bind_param("isssssi", $post_category, $post_title, $post_author, $post_image, $post_content, $post_tags, $post_comment_count);
                // if ($query->execute()) {
                //     echo ('<div class="alert alert-success text-center alertFadeout"><strong>Članak dodan.</strong></div>');
                // } else {
                //     echo ('<div class="alert alert-warning text-center alertFadeout"><strong>Greška!</strong></div>');
                // }
            }
            ?>

            <form class="form_validation" action="" method="POST" enctype="multipart/form-data" novalidate>
                <div class="form-group">
                    <label for="post_title" class="font-weight-bold">Naslov članka</label>
                    <input type="text" class="form-control" name="post_title" id="post_title" maxlength="255" required>
                    <div class="invalid-feedback">Naslov članka je obavezan! (Max. 255 znakova)</div>
                </div>
                <div class="form-group">
                    <label for="post_category" class="font-weight-bold">Kategorija članka</label>
                    <?php
                        $query = "SELECT * FROM categories";
                        $rezultat = $db->query($query);
                        echo '<select class="custom-select" name="post_category" id="post_category" required>';
                        echo '<option selected value="">Odaberite kategoriju.</option>';
                        if ($rezultat) {
                            while ($redak = $rezultat->fetch_assoc()) {
                                echo '<option value="' . $redak['cat_id'] . '">' . $redak['cat_title'] . '</option>';
                            }
                        } else {
                            echo '<option selected value="">Niste dodali barem jednu kategoriju.</option>';
                        }
                        echo '</select>';
                    ?>
                    <div class="invalid-feedback">Kategorija članka je obavezna!</div>
                </div>
                <div class="form-group">
                    <label for="post_author" class="font-weight-bold">Autor članka</label>
                    <input type="text" class="form-control" name="post_author" id="post_author" maxlength="50" required>
                    <div class="invalid-feedback">Autor članka je obavezan! (Max. 50 znakova)</div>
                </div>
                <div class="form-group">
                    <label for="post_image" class="font-weight-bold">Slika članka</label>
                    <input type="file" class="form-control" name="post_image" id="post_image" accept="image/png, image/jpeg, image/gif, image/bmp" required>
                    <div class="invalid-feedback">Slika članka je obavezna!</div>
                </div>
                <div class="form-group">
                    <label for="post_tags" class="font-weight-bold">Tagovi</label>
                    <input type="text" class="form-control" name="post_tags" id="post_tags" maxlength="255" required>
                    <div class="invalid-feedback">Tagovi članka su obavezni! Stavite barem jedan tag vezan uz sadržaj članka. (Max. 255 znakova)</div>
                </div>
                <div class="form-group">
                    <label for="post_content" class="font-weight-bold">Sadržaj članka</label>
                    <textarea class="form-control" name="post_content" id="post_content" cols="30" rows="10" required></textarea>
                    <div class="invalid-feedback">Sadržaj članka je obavezan!</div>
                </div>
                <div class="form-group">
                    <button class="btn btn-success" type="submit" name="create_post">Dodaj članak</button>
                </div>
            </form>
            <!-- // Dodavanje clanka -->
        </main>
    </div>
</div>

<?php 
echo '<script>
    document.querySelector("#posts_submenu").classList.add("show");
</script>';
?>

<?php require_once "includes/admin_footer.php"; ?>